<?php

namespace App\Controllers;

class ReportController extends AbstractController{
    public $model, $uinModel, $markModel, $memcached,
                $reports,
                $districts,
                $marks,
                $sop,
                $str,
                $iso,
                $user,
                $statuses,
                $indexes,
                $mark_1;

    public function __construct() {
        $this->model            = new \App\Models\ReportModel;
        $this->uinModel         = new \App\Models\UINModel;
        $this->markModel        = new \App\Models\MarkModel;
        $this->statuses         = new \App\Models\StatusModel;
        $this->indexes         = new \App\Models\IndexModel;
        $this->users = new \App\Models\UserModel;
        $this->memcached        = (object) $this->connMCD();
        $this->user = new UserController();

//        $this->setCache();

    }

    public function reports() {
        $reports = [];
        $district = $this->uinModel->findOneBy(['slug' => $_GET['district']]);

        foreach ($this->model->findBy(['id_uin' => $district['id']]) as $key => $report) {
            $reports[$key] = [
                'report' => $report,
                'boss' => $this->users->findOneBy(['id' => $report['id_userBoss']]),
                'staff' => $this->users->findOneBy(['id' => $report['id_userStaff']]),
                'status' => $this->statuses->findOneBy(['id' => $report['status']])
            ];
        }

        $this->render('/staff/report/reports.php', [
            'reports' => $reports,
            'district' => $district
        ]);
    }

    public function report() {
        $report = $this->model->findOneBy(['id' => $_GET['id']]);

        $data = [
            'report' => $report,
            'district' => $this->uinModel->findOneBy(['id' => $report['id_uin']]),
            'boss' => $this->users->findOneBy(['id' => $report['id_userBoss']]),
            'staff' => $this->users->findOneBy(['id' => $report['id_userStaff']]),
            'status' => $this->statuses->findOneBy(['id' => $report['status']])
        ];

        $this->render('/staff/report/report.php', [
            'data' => $data
        ]);
    }

    public function new() {
        $district = $this->uinModel->findOneBy(['id' => $this->user()->uin['id']]);

        if ($_POST) {
            $entries = [
                'name' => 'Отчет ' . (new \DateTime('now'))->format('d.m.o') . ' (Район: ' . $district['owner'] . ')'
            ];

            if (isset($_POST['report_description'])) {
                $entries['description'] = $_POST['report_description'];
            }

            if (isset($_POST['report_staff'])) {
                $staffs = implode(', ', $_POST['report_staff']);
                $entries['id_userStaff'] = $staffs;
            }

            $this->model->add($entries);

            $this->redirectToRoute('/reports');
        }

        $this->render('/staff/report/form.php', [
            'staffs' => $this->users->findBy(['id_uin' => $this->user()->uin['id'], 'id_role' => 5]),
            'district' => $district
        ]);
    }

    public function setCache(){

        if(!$this->districts = $this->memcached->get('districts')){$this->memcached->set('districts', $this->uinModel->findBy(['type' => 'district']));}
        if(!$this->reports = $this->memcached->get('reports')){$this->memcached->set('reports', $this->model->getReports());}
        if(!$this->marks = $this->memcached->get('marks')){$this->memcached->set('marks', $this->markModel->findAll());}

        if(!$this->sop = $this->memcached->get('sop') && !$this->str = $this->memcached->get('str')){

            foreach($this->marks as $vm){foreach($this->districts as $vd){
                if(!empty($_4_indexa = $this->model->getIndexes([$vm['num']],[$vd['id']],[],4))){
                    $this->sop[$vm['num']][$vd['slug']] = $this->sopOstrT($_4_indexa);
                    $this->str[$vm['num']][$vd['slug']] = $this->sopOstrT($_4_indexa, 'str');
                }

            }}
            $this->memcached->set('sop', $this->sop); $this->memcached->set('str', $this->str);
        }

        if(!$this->iso = $this->memcached->get('iso')){
            $this->memcached->set('iso', $this->iso($this->sop, $this->arrayMinMax($this->sop)));}

        return $this->memcached->quit();}

    public function sopOstrT(array $_4_indexa, string $type = 'sop'){
        $_4_indexa = (!empty($_4_indexa) && is_array($_4_indexa)) ? $_4_indexa : false;

        if($_4_indexa){for($i=0;$i<4; $i++){
            $dateCreatingReport = $this->is_date($_4_indexa[$i]['id_report']['creating'])?->getTimestamp();
            $dateSubmittingReport = $this->is_date($_4_indexa[$i]['id_report']['submitting'])?->getTimestamp();
            $dateCreatingIndex = $this->is_date($_4_indexa[$i]['date'])?->getTimestamp();

            if((5 == $_4_indexa[$i]['id_status']['id']) && ($dateCreatingReport<$dateCreatingIndex || $dateSubmittingReport > $dateCreatingIndex)){
                $indexes[] = (!empty($_4_indexa[$i]['index'])) ? (float) $_4_indexa[$i]['index'] : (float) 0;
            }} // */  pa($indexes); // */
            $indexes = $this->arrayDeleteElement($indexes);
             if('sop' == $type){
                if(isset($indexes[0]) && isset($indexes[1])){unset($indexes[3]);}// */ pa($indexes); // */
                 $count = count($indexes);

                return (3 <= $count) ? array_sum($indexes) / $count : (float) 0.00;
             }else
             if('str' == $type){$pow = (1/3); // */ echo '-1<br>'; // */
                 if(empty($indexes[0]) && empty($indexes[1])){return (float) 0;} // */ echo '-2<br>'; // */
                 if(empty($indexes[3]) && empty($indexes[2])){$return = (empty($indexes[0])) ? $indexes[1] : $indexes[0]; return $return ** $pow;} // */ echo '-3<br>'; // */
                 if(!empty($indexes[1])){$return[] = (0 < ($_1 = ($indexes[0]/$indexes[1]))) ? $_1 : 0;} // */ echo '-4<br>'; // */
                 if(!empty($indexes[2])){$return[] = (0 < ($_2 = ($indexes[1]/$indexes[2]))) ? $_2 : 0;} // */ echo '-5<br>'; // */
                 if(!empty($indexes[3])){$return[] = (0 < ($_3 = ($indexes[2]/$indexes[3]))) ? $_3 : 0;} // */ echo '-6<br>'; // */
                 $return = $this->arrayDeleteElement($return,[0]);

                 return (!empty($return)) ? array_product($return) ** $pow : (float) 0.00;
             }
        }
    return false;}

    public function iso(array $sop, array $sopminmax){
        if(!is_array($sop) && empty($sop) && !is_array(current($sop)) && !is_array($sopminmax) && empty($sopminmax) && !is_array(current($sopminmax))){return false;}
        foreach($sop as $mark => $districts){foreach($districts as $district => $sopO){
            $delimoe = ($sopO - $sopminmax['min'][$mark]);
            $delitel = ($sopminmax['max'][$mark]- $sopminmax['min'][$mark]);
            $return[$mark][$district] = (0 !== $delitel && !empty($delitel)) ? $delimoe/$delitel : 0;
        }}
        return (is_array($return) && !empty($return)) ? $return : false;}
}
