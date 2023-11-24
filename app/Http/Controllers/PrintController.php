<?php

namespace App\Http\Controllers;

use Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrintController extends Controller
{
    public function prnpriview(Request $request) {
        $idPO = $request->get('id');
        $printPoData = collect(\DB::select("
                        SELECT
                            A.IDPO, A.IDPR, A.NOADJUST, A.TANGGALPO, A.IDSUPPLIER, A.FPPN, A.JUMLAHPO, 
                            A.DISCAMOUNT, A.DISCPERCENT, A.IDTOP, A.FKLC, A.TOPDESC, A.TGLDELIVERY, A.IDCURRENCY, 
                            A.SISANILAI, A.DECBLAIN, A.BLAIN, A.DAYS, A.REVNO, A.REVDATE, A.LASTBPB, A.VOUCHER, 
                            A.TANGGALENTRI, FCANCEL, ADJCODE, REMARKS, FCOPY, 
                            A.WHSCODE, A.PENALTY, A.FHABIS, A.DICOPY, A.NOPOOLD, A.SETUP, 
                            CAST(A.TOPNOTES AS VARCHAR(3000)) AS TOPNOTES, 
                            A.PAYMENT, A.DP, A.YBI, A.KOMPENSASI, A.NOCOM, A.SELISIH, A.SALDOSLH, 
                            A.NILAIACC, A.TARIKACC, A.APCLOSE, A.FBEBASPPN, A.TYBC, A.NOFORMD, A.TAHUNHS, A.NOHS, 
                            A.FSTOCKCODE, A.FAPPROVE, A.APPROVEDATE, A.USERNAME, A.TGLINPUT, A.TNOPPN, A.SNOPPN, A.JSPR, 
                            A.NP8P, A.FESTIMASI, A.FPOJASA,
                            B.NAMA AS NAMA_VENDOR, B.FAX, B.ALAMAT, B.IDACCOUNT AS ACCSUPL,
                            C.IDACCOUNT, C.IDDEPPEMBUAT, C.NOSKK, B.PKP,
                            --IIF(FPPN='Y', 0.1, 0) AS PCT_PPN,
                            IIF(A.FPPN='Y', Y2.PPNRATE, 0) AS PCT_PPN, 
                            COALESCE(B.JPKP, '0') AS JPKP,
                            C.TANGGALTRM, COALESCE(C.IDPROYEK, '      ') AS IDPROYEK,
                            --X.TOTAL_PPN,X.TOTAL_PO,
                            Y2.TOTAL_PPN, Y2.BRUTO AS TOTAL_PO,
                            --Y.DISKON,
                            Y2.DPVAL AS DISKON, 
                            A.KODEASALINPUT,A.FPPNPBBKB, A.PPNPBBKB,
                            Y2.TOTAL_PPN AS NILAIPPN,
                            IIF(Z.BKPM='Y','BKPM','') AS BKPM,
                            PRE.SCANTTD AS TTDPRE, CHE.SCANTTD AS TTDCH, APR.SCANTTD AS TTDAPR, 
                            PRE.NAMA AS PREPAREDBY, CHE.NAMA AS CHECKEDBY, APR.NAMA AS APPROVEDBY,
                            CHE2.SCANTTD AS TTDCH2,
                            A.NPKINPUT, INP.SCANTTD AS TTDINPUT, INP.SCANPARAF AS PARAFINPUT,
                            A.APPROVEDIR, A.APPROVEZA,
                            CHE.SCANPARAF AS PARAFCHECK,
                            A.DATEAPPROVEBB, A.DATEAPPROVEZA, COALESCE(A.DATEAPPROVEBB, A.DATEAPPROVEZA) AS TGLAPPROVE, 
                            A.TIMESTAMPREVISION,
                            --  IIF(EXISTS(SELECT 1 FROM ))
                            REV.IDPO AS IDPOREVISI, REV.DATEREVISI,  -- REVISI TERKAIT PPN 10% | 11%
                            REV.REVNOREVISI,    -- 14-04-2022 WG MEMO INTERN no 006/PURCH/IV/22
                            (Select count(*) from PCL_PURCHASEORDERITEM P1
                            left join PCS_REFBARANG P2 on P2.idbarang=P1.idbarang
                            Where P1.idpo=A.idpo and P2.B3='Y') as B3, KONTRAKTOR
                        FROM PCL_PURCHASEORDER A
                        LEFT JOIN PCL_REFSUPPLIER B ON (B.IDSUPPLIER=A.IDSUPPLIER)
                        LEFT JOIN PCL_PRPURCHASE C ON (C.IDPR=A.IDPR)
                        LEFT JOIN PCL_GETNILAIPO_V1(A.IDPO) Y2 ON (1=1)
                        LEFT JOIN PRO_KIPIASSETPROYEK Z ON C.IDPROYEK=Z.IDPROYEK
                        LEFT JOIN APP_REFDOKUMENROLE PRE ON (PRE.IDKARYAWAN = A.NPKPREPARE)
                        LEFT JOIN APP_REFDOKUMENROLE CHE ON (CHE.IDKARYAWAN = A.NPKCHECK)
                        LEFT JOIN APP_REFDOKUMENROLE CHE2 ON (CHE2.IDKARYAWAN = A.NPKCHECK2)
                        LEFT JOIN APP_REFDOKUMENROLE APR ON (APR.IDKARYAWAN = A.NPKAPPROV)
                        LEFT JOIN APP_REFDOKUMENROLE INP ON (INP.IDKARYAWAN = A.NPKINPUT)
                        LEFT JOIN (
                            SELECT STRKEYGROUP AS IDPO, CAST(ENTRITIME AS DATE) AS DATEREVISI, VALUEINT2 AS REVNOREVISI  
                            FROM APP_REFCUSTOMDATA  
                            WHERE KAI=60 AND INTKEYGROUP=10 AND VALUEINT=-999
                        ) REV ON (REV.IDPO= A.IDPO) 
                        WHERE A.IDPO=:IDPO", 
                        array(
                            'IDPO' => $idPO 
                        )))->first();

        $printPoItem = DB::table('PCL_PURCHASEORDERITEM')
                     ->join('PCS_REFBARANG', 'PCL_PURCHASEORDERITEM.IDBARANG', '=', 'PCS_REFBARANG.IDBARANG')
                     ->select('PCL_PURCHASEORDERITEM.*', 'PCS_REFBARANG.BARANGTIPE')
                     ->where('IDPO',$idPO)
                     ->get();

        $parafInput = base64_encode($printPoData->PARAFINPUT);
        $parafCheck = base64_encode($printPoData->PARAFCHECK);
        $ttdApprove = base64_encode($printPoData->TTDAPR);
        $ttdCheck = base64_encode($printPoData->TTDCH);
        $ttdPre = base64_encode($printPoData->TTDPRE);

        $subtotal = $printPoData->TOTAL_PO ? $printPoData->TOTAL_PO : 0;
        $discount = $printPoData->DISCPERCENT != 0 ? $printPoData->DISCPERCENT * $subtotal : $printPoData->DISCAMOUNT;
        $netto    = (int)$subtotal - (int)$discount;
        
        return view('purchase-orders-print', compact('printPoItem', 'printPoData', 'ttdApprove', 'ttdCheck', 'ttdPre', 'parafInput', 'parafCheck', 'subtotal', 'netto'));
    }

    public function prnpriviewManagementMaterial(Request $request) {
        $idDocket = $request->get('id');
        $printManagementMaterialData = collect(\DB::select("
                        SELECT WHS_DOCKET.*, PCL_REFSUPPLIER.NAMA  FROM WHS_DOCKET
                        JOIN PCL_REFSUPPLIER ON WHS_DOCKET.WHSCOMP = PCL_REFSUPPLIER.WCCENTRE 
                        WHERE WHS_DOCKET.IDDOCKET = :IDDOCKET", 
                        array(
                            'IDDOCKET' => $idDocket 
                        )))->first();
        
        return view('management-material-print', compact('printManagementMaterialData'));
    }

    public function prnpriviewLaporan(Request $request) {
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        
        $WHSCODE      = 'PCM';
        $TGL1         = $startDate;
        $TGL2         = $endDate;
        $MINUS        = 'N';

        $result = DB::select("
                SELECT AA.*,
                CASE
                    WHEN '".$WHSCODE."' = 'COMP' AND BB.IDSTOCK IS NOT NULL THEN COALESCE(AA.QTYBTI,0) + COALESCE(AA.QTYBTC,0)
                    ELSE 0
                END AS QTYLEGRIDYBI
                FROM (
                    SELECT 
                    A.GROUPCODE, A.IDSTOCK, A.KET, 
                    CAST(A.QTYOPEN AS NUMERIC(15,2)) AS QTYOPEN,
                    CAST(A.QTYADJ AS NUMERIC(15,2)) AS QTYADJ,
                    A.QTYBPB,
                    CAST(A.QTYBRB AS NUMERIC(15,2)) AS QTYBRB,
                    CAST(A.QTYBTC AS NUMERIC(15,2)) AS QTYBTC,
                    A.QTYSJA,
                    CAST(A.QTYMFU AS NUMERIC(15,2)) AS QTYMFU,
                    CAST(A.QTYPRD AS NUMERIC(15,2)) AS QTYPRD,
                    CAST(A.QTYRCY AS NUMERIC(15,2)) AS QTYRCY,
                    CAST(A.QTYSCP AS NUMERIC(15,2)) AS QTYSCP,
                    CAST(A.QTYBTO AS NUMERIC(15,2)) AS QTYBTO,
                    COALESCE(Z.COM1IN,0) AS COOM1IN,
                    COALESCE(Y.COM1OUT,0) AS COOM1OUT, 
                    COALESCE(C.OTHOUT,0) AS OTH1OUT,
                    COALESCE(X.COMDIN,0) AS COMDIN,
                    COALESCE(X.COMDOUT,0) AS COMDOUT,
                    COALESCE(B.SJA,0) AS SJA, A.LANGSUNG,
                    CASE
                        WHEN '".$WHSCODE."' ='AMIX' THEN
                        CAST(A.QTYBTI AS NUMERIC(15,2)) + CAST(A.QTYBPB AS NUMERIC(15,2))
                        ELSE CAST(A.QTYBTI AS NUMERIC(15,2))
                    END AS QTYBTI,
                    (QTYOPEN+(QTYBTI+QTYBTC)+QTYBPB-(QTYBTO+QTYBRB)+QTYADJ-(QTYSCP+QTYRCY)) AS ENDING
                FROM WHS_GETSOHHARIAN('".$WHSCODE."', null, '".$TGL1."', '".$TGL2."') A
                LEFT JOIN (
                    SELECT
                    IDSTOCK,SUM(QUANTITY) AS COM1IN
                    FROM WHS_STOCKMOVETRANS
                    WHERE TANGGAL BETWEEN '".$TGL1."' AND '".$TGL2."'
                    AND TRANSTYPE='BTI' AND WHSCODE='COM1'
                    GROUP BY IDSTOCK) Z ON A.IDSTOCK=Z.IDSTOCK
                LEFT JOIN (
                    SELECT
                    IDSTOCK,SUM(QUANTITY) AS COM1OUT
                    FROM WHS_STOCKMOVETRANS
                    WHERE TANGGAL BETWEEN '".$TGL1."' AND '".$TGL2."'
                    AND TRANSTYPE='BTO' AND WHSCODE='COM1'
                    GROUP BY IDSTOCK) Y ON A.IDSTOCK=Y.IDSTOCK
                LEFT JOIN (
                    SELECT
                    IDSTOCK,SUM(QUANTITY) AS OTHOUT
                    FROM WHS_STOCKMOVETRANS
                    WHERE TANGGAL BETWEEN '".$TGL1."' AND '".$TGL2."'
                    AND TRANSTYPE='BTI' AND (WHSCODE='PE' OR WHSCODE='PTD' OR WHSCODE='HLD' OR WHSCODE='PPD' OR WHSCODE='GCY')
                    GROUP BY IDSTOCK) C ON A.IDSTOCK=C.IDSTOCK
                LEFT JOIN (
                    SELECT
                    IDSTOCK, SUM(CASE WHEN TRANSTYPE='BTI' THEN QUANTITY ELSE 0.000 END ) AS COMDIN,
                    SUM(CASE WHEN TRANSTYPE='BTO' THEN QUANTITY ELSE 0.000 END ) AS COMDOUT
                    FROM WHS_STOCKMOVETRANS
                    WHERE TANGGAL BETWEEN '".$TGL1."' AND '".$TGL2."'
                    AND TRANSTYPE IN ('BTI','BTO') AND (WHSCODE='COMD')
                    GROUP BY IDSTOCK )   X ON A.IDSTOCK=X.IDSTOCK     
                LEFT JOIN (
                    SELECT SJI.IDSTOCK,SUM(SJI.QUANTITY) AS SJA
                    FROM COM_SURATJALANITEM SJI
                    LEFT JOIN COM_SURATJALAN SJ ON SJ.NOSJ=SJI.NOSJ
                    WHERE SJ.TANGGALSJ BETWEEN '".$TGL1."' AND '".$TGL2."'
                    GROUP BY SJI.IDSTOCK)B ON A.IDSTOCK=B.IDSTOCK
                WHERE 
                    A.LANGSUNG <>'Y' 
                    AND A.GROUPCODE<>'EXP' AND A.GROUPCODE <> 'LEZ'
                    OR (LANGSUNG <>'Y' AND A.WHSCODE_OUT<>'COMP' AND A.GROUPCODE = 'LEZ')
                    ORDER BY GROUPCODE, IDSTOCK
                ) AA
                LEFT JOIN WHS_REFSTOCKLEGRIDYBI BB ON BB.IDSTOCK=AA.IDSTOCK
                WHERE (('".$MINUS."'='Y' AND AA.ENDING < 0 ) OR 
                ('".$MINUS."'='N' AND AA.ENDING=AA.ENDING OR AA.ENDING < 0))
        ");

        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;
        
        return view('laporan-print', compact(['result', 'data']));
    }
}
