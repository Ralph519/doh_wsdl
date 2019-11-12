<?php

namespace App\Http\Controllers;

use Artisaninweb\SoapWrapper\SoapWrapper;

use Illuminate\Http\Request;

use App\hospitalsumpatient;
use App\hospitalbedcapacity;
use App\hospitalclass;
use App\hospitaldblist;
use App\hospitaldelivery;
use App\hospitaldischamorbid;
use App\hospitaldischarge;
use App\hospitaldischargeer;
use App\hospitaldischargeopd;

class dohWsdlController extends Controller
{
    /**
     * @var SoapWrapper
     */
    protected $soapWrapper;

    /**
     * SoapController constructor.
     *
     * @param SoapWrapper $soapWrapper
     */
    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }

    /**
     * Use the SoapWrapper
     */

    public function getDataTable(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });
        
        $dbList = hospitaldblist::all();
        
        foreach($dbList as $db) {
          $data = $this->soapWrapper->call('dohWsdl.getDataTable', [
              "hfhudcode" => $db->hfhudcode,
              "year" => $db->year, 
              "table" => $db->table,
          ]);
 
           var_dump($data);
        }
    }

    public function genInfoClassification(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });
        
        $hospitalclass = hospitalclass::all();
        
        foreach($hospitalclass as $class) {
          $data = $this->soapWrapper->call('dohWsdl.genInfoClassification', [
              "hfhudcode" => $class->hfhudcode,
              "servicecapability" => $class->servicecapability, 
              "general" => $class->general,
              "specialty" => $class->specialty,
              "specialtyspecify" => $class->specialtyspecify,
              "traumacapability" => $class->traumacapability,
              "natureofownership" => $class->natureofownership,
              "government" => $class->government,
              "national" => $class->national,
              "local" => $class->local,
              "private" => $class->private,
              "reportingyear" => $class->reportingyear,
              "ownershipothers" => $class->ownershipothers,
            ]);

            var_dump($data);
          }
 
    }

    public function genInfoQualityManagement(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.genInfoQualityManagement', [
            "hfhudcode" => $request->input('code'),
            "qualitymgmttype" => 1,
            "description" => "ALL AREAS",
            "certifyingbody" => "TUV-RHINELAND",
            "philhealthaccreditation" => "",
            "validityfrom" => "2016-01-01",
            "validityto" => "2016-12-31",
            "reportingyear" => 2016,
   	     ]);
 
   	     var_dump($data);
    }

    public function genInfoBedCapacity()
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $bedCapacity = hospitalbedcapacity::all();

          foreach($bedCapacity as $capacity) {
            $data = $this->soapWrapper->call('dohWsdl.genInfoBedCapacity', [
              "hfhudcode" => $capacity->hfhudcode,
              "abc" => $capacity->abc,
              "implementingbeds" => $capacity->implementingbeds,
              "bor" => $capacity->bor,
              "reportingyear" => $capacity->reportingyear
            ]);
            var_dump($data);
          }
 
   	     
    }

    public function hospOptSummaryOfPatients()
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $summPatients = hospitalsumpatient::all();

          foreach($summPatients as $summPatient) {
            $data = $this->soapWrapper->call('dohWsdl.hospOptSummaryOfPatients', [
              "hfhudcode" => $summPatient->hfhudcode,
              "totalinpatients" => $summPatient->totalinpatients,
              "totalnewborn" => $summPatient->totalnewborn,
              "totaldischarges" => $summPatient->totaldischarges,
              "totalpad" => $summPatient->totalpad,
              "totalibd" => $summPatient->totalibd,
              "totalinpatienttransto" => $summPatient->totalinpatienttransto,
              "totalinpatienttransfrom" => $summPatient->totalinpatienttransfrom,
              "totalpatientsremaining" => $summPatient->totalpatientsremaining,
              "reportingyear" => $summPatient->reportingyear,
            ]);
            var_dump($data);
          }

    }

    public function hospOptDischargesSpecialty(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $dischargeSpecialty = hospitaldischarge::all();

          foreach($dischargeSpecialty as $specialty) {
            $data = $this->soapWrapper->call('dohWsdl.hospOptDischargesSpecialty', [
              "hfhudcode" => $specialty->hfhudcode,
              "typeofservice" => $specialty->typeofservice,
              "nopatients" => $specialty->nopatients,
              "totallengthstay" => $specialty->totallengthstay,
              "nppay" => $specialty->nppay,
              "nphservicecharity" => $specialty->nphservicecharity,
              "nphtotal" => $specialty->nphtotal,
              "phpay" => $specialty->phpay,
              "phservice" => $specialty->phservice,
              "phtotal" => $specialty->phtotal,
              "hmo" => $specialty->hmo,
              "owwa" => $specialty->owwa,
              "recoveredimproved" => $specialty->recoveredimproved,
              "transferred" => $specialty->transferred,
              "hama" => $specialty->hama,
              "absconded" => $specialty->absconded,
              "unimproved" => $specialty->unimproved,
              "deathsbelow48" => $specialty->deathsbelow48,
              "deathsover48" => $specialty->deathsover48,
              "totaldeaths" => $specialty->totaldeaths,
              "totaldischarges" => $specialty->totaldischarges,
              "remarks" => $specialty->remarks,
              "reportingyear" => $specialty->reportingyear,
          ]);
  
          var_dump($data);
        }
    }

    public function hospOptDischargesMorbidity(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $morbids = hospitaldischamorbid::all();

          foreach($morbids as $morbid) {
            $data = $this->soapWrapper->call('dohWsdl.hospOptDischargesMorbidity', [
              "hfhudcode" => $morbid->hfhudcode,
              "icd10desc" => $morbid->icd10desc,
              "munder1" => $morbid->munder1,
              "funder1" => $morbid->funder1,
              "m1to4" => $morbid->m1to4,
              "f1to4" => $morbid->f1to4,
              "m5to9" => $morbid->m5to9,
              "f5to9" => $morbid->f5to9,
              "m10to14" => $morbid->m10to14,
              "f10to14" => $morbid->f10to14,
              "m15to19" => $morbid->m15to19,
              "f15to19" => $morbid->f15to19,
              "m20to24" => $morbid->m20to24,
              "f20to24" => $morbid->f20to24,
              "m25to29" => $morbid->m25to29,
              "f25to29" => $morbid->f25to29,
              "m30to34" => $morbid->m30to34,
              "f30to34" => $morbid->f30to34, 
              "m35to39" => $morbid->m35to39, 
              "f35to39" => $morbid->f35to39, 
              "m40to44" => $morbid->m40to44, 
              "f40to44" => $morbid->f40to44, 
              "m45to49" => $morbid->m45to49, 
              "f45to49" => $morbid->f45to49, 
              "m50to54" => $morbid->m50to54, 
              "f50to54" => $morbid->f50to54, 
              "m55to59" => $morbid->m55to59, 
              "f55to59" => $morbid->f55to59, 
              "m60to64" => $morbid->m60to64, 
              "f60to64" => $morbid->f60to64, 
              "m65to69" => $morbid->m65to69, 
              "f65to69" => $morbid->f65to69, 
              "m70over" => $morbid->m70over, 
              "f70over" => $morbid->f70over, 
              "msubtotal" => $morbid->msubtotal, 
              "fsubtotal" => $morbid->fsubtotal, 
              "grandtotal" => $morbid->grandtotal, 
              "icd10code" => $morbid->icd10code, 
              "icd10category" => $morbid->icd10category, 
              "reportingyear" => $morbid->reportingyear,
          ]);
  
            var_dump($data);
      }
    }

    public function hospOptDischargesNumberDeliveries(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $deliveries = hospitaldelivery::all();
        
          foreach($deliveries as $delivery) {

            $data = $this->soapWrapper->call('dohWsdl.hospOptDischargesNumberDeliveries', [
              "hfhudcode" => $delivery->hfhudcode,
              "totalifdelivery" => $delivery->totalifdelivery, 
              "totallbvdelivery" => $delivery->totallbvdelivery, 
              "totallbcdelivery" => $delivery->totallbcdelivery, 
              "totalotherdelivery" => $delivery->totalotherdelivery, 
              "reportingyear" => $delivery->reportingyear,
            ]);
  
            var_dump($data);
          }
    }

    public function hospOptDischargesOPV(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.hospOptDischargesOPV', [
            "hfhudcode" => $request->input('code'),
            "newpatient" => 3330, 
            "revisit" => 28922, 
            "adult" => 16984, 
            "pediatric" => 11938, 
            "adultgeneralmedicine" => 10987, 
            "specialtynonsurgical" => 587, 
            "surgical" => 551, 
            "antenatal" => 2388, 
            "postnatal" => 1434, 
            "reportingyear" => 2016,
   	     ]);
 
   	     var_dump($data);
    }

    public function hospOptDischargesOPD(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $dischargedOpd = hospitaldischargeopd::all();
        
          foreach($dischargedOpd as $opd) {

            $data = $this->soapWrapper->call('dohWsdl.hospOptDischargesOPD', [
              "hfhudcode" => $opd->hfhudcode,
              "opdconsultations" => $opd->opdconsultations, 
              "number" => $opd->number, 
              "icd10code" => $opd->icd10code, 
              "icd10category" => $opd->icd10category, 
              "reportingyear" => $opd->reportingyear,
          ]);
  
          var_dump($data);
        }
    }

    public function hospOptDischargesER(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });
          
          $dischargeEr = hospitaldischargeer::all();

          foreach($dischargeEr as $er) {

            $data = $this->soapWrapper->call('dohWsdl.hospOptDischargesER', [
              "hfhudcode" => $er->hfhudcode,
              "erconsultations" => $er->erconsultations, 
              "number" => $er->number, 
              "icd10code" => $er->icd10code, 
              "icd10category" => $er->icd10category, 
              "reportingyear" => $er->reportingyear,
          ]);
  
          var_dump($data);
        }
    }

    public function hospOptDischargesEV(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.hospOptDischargesEV', [
            "hfhudcode" => $request->input('code'),
            "emergencyvisits" => 14257, 
            "emergencyvisitsadult" => 10145, 
            "emergencyvisitspediatric" => 4112, 
            "evfromfacilitytoanother" => 265, 
            "reportingyear" => 2016
   	     ]);
 
   	     var_dump($data);
    }

    public function hospitalOperationsDeaths(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.hospitalOperationsDeaths', [
            "hfhudcode" => $request->input('code'),
            "totaldeaths" => 257, 
            "totaldeaths48down" => 99, 
            "totaldeaths48up" => 158, 
            "totalerdeaths" => 4, 
            "totaldoa" => 54, 
            "totalstillbirths" => 4, 
            "totalneonataldeaths" => 8, 
            "totalmaternaldeaths" => 0, 
            "totaldeathsnewborn" => "", 
            "totaldischargedeaths" => "", 
            "grossdeathrate" => "", 
            "ndrnumerator" => "", 
            "ndrdenominator" => "", 
            "netdeathrate" => "", 
            "reportingyear" => 2016
   	     ]);
 
   	     var_dump($data);
    }

    public function hospitalOperationsMortalityDeaths(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $morbids = hospitaldischamorbid::all();

          foreach($morbids as $morbid) {
            $data = $this->soapWrapper->call('dohWsdl.hospitalOperationsMortalityDeaths', [
              "hfhudcode" => $morbid->hfhudcode,
              "icd10desc" => $morbid->icd10desc, 
              "munder1" => $morbid->munder1, 
              "funder1" => $morbid->funder1, 
              "m1to4" => $morbid->m1to4, 
              "f1to4" => $morbid->f1to4, 
              "m5to9" => $morbid->m5to9, 
              "f5to9" => $morbid->f5to9, 
              "m10to14" => $morbid->m10to14, 
              "f10to14" => $morbid->f10to14, 
              "m15to19" => $morbid->m15to19, 
              "f15to19" => $morbid->f15to19, 
              "m20to24" => $morbid->m20to24, 
              "f20to24" => $morbid->f20to24,
              "m25to29" => $morbid->m25to29, 
              "f25to29" => $morbid->f25to29, 
              "m30to34" => $morbid->m30to34, 
              "f30to34" => $morbid->f30to34, 
              "m35to39" => $morbid->m35to39, 
              "f35to39" => $morbid->f35to39, 
              "m40to44" => $morbid->m40to44, 
              "f40to44" => $morbid->f40to44, 
              "m45to49" => $morbid->m45to49, 
              "f45to49" => $morbid->f45to49, 
              "m50to54" => $morbid->m50to54, 
              "f50to54" => $morbid->f50to54, 
              "m55to59" => $morbid->m55to59, 
              "f55to59" => $morbid->f55to59, 
              "m60to64" => $morbid->m60to64, 
              "f60to64" => $morbid->f60to64, 
              "m65to69" => $morbid->m65to69, 
              "f65to69" => $morbid->f65to69, 
              "m70over" => $morbid->m70over, 
              "f70over" => $morbid->f70over, 
              "msubtotal" => $morbid->msubtotal, 
              "fsubtotal" => $morbid->fsubtotal, 
              "grandtotal" => $morbid->grandtotal, 
              "icd10code" => $morbid->icd10code, 
              "icd10category" => $morbid->icd10category, 
              "reportingyear" => $morbid->reportingyear,
          ]);
  
          var_dump($data);
        }
    }

    public function hospitalOperationsHAI(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.hospitalOperationsHAI', [
            "hfhudcode" => $request->input('code'),
            "numhai" => "", 
            "numdischarges" => "", 
            "infectionrate" => 0.60, 
            "patientnumvap" => "", 
            "totalventilatordays" => "", 
            "resultvap" => 13.60, 
            "patientnumbsi" => "", 
            "totalnumcentralline" => "", 
            "resultbsi" => 11.10, 
            "patientnumuti" => "", 
            "totalcatheterdays" => "", 
            "resultuti" => 0.00, 
            "numssi" => "", 
            "totalproceduresdone" => "", 
            "resultssi" => 0.00, 
            "reportingyear" => 2016 
   	     ]);
 
   	     var_dump($data);
    }

    public function hospitalOperationsMajorOpt(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.hospitalOperationsMajorOpt', [
            "hfhudcode" => $request->input('code'),
            "operationcode" => "", 
            "surgicaloperation" => "Bilateral Tubal Ligation", 
            "number" => 14, 
            "reportingyear" => 2016
   	     ]);
 
   	     var_dump($data);
    }

    public function hospitalOperationsMinorOpt(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.hospitalOperationsMinorOpt', [
            "hfhudcode" => $request->input('code'),
            "operationcode" => "", 
            "surgicaloperation" => "Lacerated Wound", 
            "number" => 280, 
            "reportingyear" => 2016
   	     ]);
 
   	     var_dump($data);
    }

    public function staffingPattern(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.staffingPattern', [
            "hfhudcode" => $request->input('code'),
            "professiondesignation" => 1, 
            "specialtyboardcertified" => 0, 
            "fulltime40permanent" => 0, 
            "fulltime40contractual" => 0, 
            "parttimepermanent" => 0, 
            "parttimecontractual" => 0, 
            "activerotatingaffiliate" => 0, 
            "outsourced" => 0, 
            "reportingyear" => 2016
   	     ]);
 
   	     var_dump($data);
    }

    public function staffingPatternOthers(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.staffingPatternOthers', [
            "hfhudcode" => $request->input('code'),
            "parent" => 10, 
            "professiondesignation" => "DERMATOLOGY", 
            "specialtyboardcertified" => "", 
            "fulltime40permanent" => 0, 
            "fulltime40contractual" => 0, 
            "parttimepermanent" => 0, 
            "parttimecontractual" => 0, 
            "activerotatingaffiliate" => 10, 
            "outsourced" => 0, 
            "reportingyear" => 2016
   	     ]);
 
   	     var_dump($data);
    }

    public function expenses(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.expenses', [
            "hfhudcode" => $request->input('code'),
            "salarieswages" => 9581832, 
            "employeebenefits" => 2396497, 
            "allowances" => 2442286, 
            "totalps" => 14420615, 
            "totalamountmedicine" => 0, 
            "totalamountmedicalsupplies" => 3846662, 
            "totalamountutilities" => 493067, 
            "totalamountnonmedicalservice" => 2103826, 
            "totalmooe" => 13512412, 
            "amountinfrastructure" => 0, 
            "amountequipment" => 0, 
            "totalco" => 0, 
            "grandtotal" => 48797196, 
            "reportingyear" => 2016
   	     ]);
 
   	     var_dump($data);
    }

    public function revenues(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.revenues', [
            "hfhudcode" => $request->input('code'),
            "amountfromdoh" => 0, 
            "amountfromlgu" => 0, 
            "amountfromdonor" => 0, 
            "amountfromprivateorg" => 0, 
            "amountfromphilhealth" => 11521696, 
            "amountfrompatient" => 372380.21875, 
            "amountfromreimbursement" => 0, 
            "amountfromothersources" => 443611, 
            "grandtotal" => 12337687, 
            "reportingyear" => 2016
   	     ]);
 
   	     var_dump($data);
    }

    public function submittedReports(Request $request)
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.submittedReports', [
            "hfhudcode" => $request->input('code'),
            "reportingyear" => 2016, 
            "reportingstatus" => "S", 
            "reportedby" => "JUAN DELA CRUZ", 
            "designation" => "MEDICAL RECORDS OFFICER I", 
            "section" => "MEDICAL RECORDS", 
            "department" => "", 
            "datereported" => "2017-07-22", 
            "validatedby" => "DOHHFSRB", 
            "datevalidated" => "2017-10-01",
   	     ]);
 
   	     var_dump($data);
    }

    public function createNEHEHRSVaccount()
    {
        $this->soapWrapper->add('dohWsdl', function ($service) {
            $service
              ->wsdl('http://uhmistrn.doh.gov.ph/ahsr/webservice/index.php?wsdl')
              ->trace(true);
          });

          $data = $this->soapWrapper->call('dohWsdl.createNEHEHRSVaccount', [
            "hfhudcode" => "NEHEHRSV201900005", 
            "hfhudname" => "EMR PROVIDER NAME", 
            "fhudaddress" => "MATAPANG ST", 
            "regcode" => "13", 
            "provcode" => "1374", 
            "ctymuncode" => "137403", 
            "bgycode" => "137403027", 
            "fhudtelno1" => "(02) 987-6543", 
            "fhudtelno2" => "", 
            "fhudfaxno" => "", 
            "fhudemail" => "emr@provider.com", 
            "headlname" => "DELA CRUZ", 
            "headfname" => "JUAN", 
            "headmname" => "", 
            "accessKey" => "123456",
   	     ]);
 
   	     var_dump($data);
    }
}
