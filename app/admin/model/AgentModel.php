<?php
/**
 * Created by PhpStorm.
 * User: 冯天元
 * Date: 2016/8/20
 * Time: 16:23
 */

namespace app\admin\model;
use PHPMailer\PHPMailer\Exception;
use think\Db;

class AgentModel
{

    public function update_apply($status,$id){
        Db::startTrans();
        try{
            $apply_info = db_func("application","agent_")->where(['id'=>$id])->find();
            $user_info = db_func("users","agent_")->where(['id'=>$apply_info['agent_user']])->find();
            $pre_money = floatval($user_info['money']);
            if($apply_info['type'] == 1){
                $after_money = $pre_money+$apply_info['value'];
            }else{
                $after_money = $pre_money-$apply_info['value'];
            }

            if($apply_info['status']==$status) throw new Exception("修改失败1");
            db_func("application","agent_")->where(['id'=>$id])->update(['status'=>$status,"check_time"=>time(),"check_user"=>get_admin_id(),"pre_money"=>$pre_money,"after_money"=>$after_money]);
            if($status == 2){
                if($apply_info['type']==1){
                    if($user_info['money']!=null){
                        $res = db_func("users","agent_")->where(['id'=>$apply_info['agent_user']])->setInc("money",floatval($apply_info['value']));
                    }else{
                        $res = db_func("users","agent_")->where(['id'=>$apply_info['agent_user']])->update(["money"=>floatval($apply_info['value'])]);
                    }

                    if(!$res) throw new Exception("修改失败2");
                }

                if($apply_info['type'] == 2){
                    if($user_info['money']!=null){
                        $res = db_func("users","agent_")->where(['id'=>$apply_info['agent_user']])->setDec("money",floatval($apply_info['value']));
                    }else{
                        $res = db_func("users","agent_")->where(['id'=>$apply_info['agent_user']])->update(["money"=>floatval($apply_info['value'])]);
                    }

                    if(!$res) throw new Exception("修改失败3");
                }
            }
            // 提交事务
            Db::commit();
            ok_return("修改成功");
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            wrong_return($e->getMessage());
        }
    }

    public function get_apply_list($status){
        $con = [];
        if(!empty($status)) $con['a.status'] = $status;
        return db_func("application a","agent_")
            ->field("a.*,u.user_login,u.phone,u.money,u2.user_login apply_admin,u3.user_login check_admin")
            ->join(['users'=>"u","agent_"],"u.id = a.agent_user","left")
            ->join(['users'=>"u2","admin_"],"u2.id = a.apply_user","left")
            ->join(['users'=>"u3","admin_"],"u3.id = a.check_user","left")
            ->where($con)
            ->order("a.create_time desc")
            ->paginate("",false,['query' =>$_GET]);
    }

    public function add_apply_change_money($change_money,$agent_user,$type){
        $type == "add"?$type = 1:$type = 2;
        $data = array(
            "agent_user"=>$agent_user['id'],
            "type"=>$type,
            "value"=>$change_money,
            "apply_user"=>get_admin_id(),
            "create_time"=>time(),
            "status"=>"1"
        );

        return db_func("application","agent_")->insert($data);
    }

    public function get_edition_info_by_id($id){
        return db_func("edition","md_")->where(['id'=>$id])->find();
    }

    public function get_agent_edition($edition){
        return db_func("edition","md_")->where(['edition'=>$edition,"status"=>1])->find();
    }

    public function save_edition($post){
        $edition = $name = null;
        extract($post);
        $data = [
            'name' => $name,
            'edition' => $edition,
            'status'=>1
        ];
        if ( empty($id) ){
            $data['create_time'] = time();
            return db_func("edition","md_")->insert($data);
        }else{
            return db_func("edition","md_")->where(['id'=>$id])->update($data);
        }
    }

    public function del_edition($id){
        return db_func("edition","md_")->where(['id'=>$id])->update(['status'=>-1]);
    }

    public function get_agent_user_list($model){
        $cond['saler_name'] = session("admin.user_login");
        if(is_super_admin()) $cond = [];
        return db_func("users u","agent_")
            ->field("u.*,count(distinct u2.id) reg_num,count(distinct o.id) order_num")
            ->join(['users'=>"u2","md_"],"u2.agent_id = u.id","left")
            ->join(['order_list'=>"o","md_"],"o.agent_id = u.id","left")
            ->where(['u.status'=>1])
            ->where($cond)
            ->where($model->wheresql)
            ->group("u.id")
            ->paginate(20);
    }

    public function get_agent_user($id){
        return db_func("users","agent_")->where(['id'=>$id,"status"=>1])->find();
    }

    public function get_card_list_by_user($uid){
        return db_func("tickets_list l","md_")
            ->join(['tickets'=>"t","md_"],"t.id = l.pid","left")
            ->where(["l.agent_id"=>$uid,"l.status"=>"1","l.use_times"=>["EGT","1"],"t.agent_show"=>'true'])
            ->count();
    }


    public function get_percentage_list($model){
        return db_func("recharge_per r","agent_")
            ->field("r.*,t.title card_name")
            ->join(["tickets"=> "t","md_"],"t.id = r.present_card","LEFT")
            ->where(['r.status'=>1])
            ->where($model->wheresql)
            ->paginate(20);
    }

    public function get_percentage($id){
        return db_func("recharge_per","agent_")->where(['id'=>$id])->find();
    }

    public function get_all_card_cate(){
        return db_func("tickets","md_")->where(['status'=>1,"agent_show"=>"true"])->select();
    }

    public function get_agent_tickets($agent_id){
        $sql = "SELECT t.*,COUNT(l.id) card_num FROM md_tickets t ";
        $sql.=" LEFT JOIN md_tickets_list l ON t.id = l.pid  AND l.status = 1  AND l.use_times >= '1' AND  l.agent_id = ".$agent_id;
        $sql.=" where t.agent_show = 'true'  AND t.status = 1 GROUP BY t.id";
        $res = Db::query($sql);
        return $res;

    }

    public function percentage_update($post){
        $data = [
            'title' => $post['title'],
            'condition_money' => $post['condition_money'],
            'present_money' => $post['present_money'],
            'discount' => $post['discount'],
            'present_card' => $post['present_card'],
            'status' => $post['status'],
            'present_card_num' => $post['present_card_num'],
        ];

        if ( empty($post['id']) ) {
            return db_func("recharge_per","agent_")->insert($data);
        } else {
            $data['id'] = $post['id'];
            return db_func("recharge_per","agent_")->update($data);
        }
    }

    public function del_percentage($id){
        return db_func("recharge_per","agent_")->where(['id'=>$id])->update(['status'=>"-1"]);
    }

    public function update_agent_user($post){
        $data = [
            'user_login' => $post['user_login'],
            'phone' => $post['phone'],
            'mail' => $post['mail'],
            'saler_name' => $post['saler_name'],
            'origin' => $post['origin'],
            'remark' => $post['remark'],
            'status' => $post['status'],
            'standards_per' => floatval($post['standards_per']),
            'senior_per' => floatval($post['senior_per']),
            'addr' => $post['addr'],
        ];

        if(!empty($post['password'])){
            $data['password'] = md6($post['password']);
        }
        if ( empty($post['id']) ) {
            $data['create_time'] = time();
            return db_func("users","agent_")->insert($data);
        } else {
            $data['id'] = $post['id'];
            /*$user_info = db_func("users","agent_")->where(['id'=>$data['id']])->find();
            if($user_info['money']!=$data['money']){
                //创建订单
                $change_money = $data['money']-$user_info['money'];
                $this->create_manual_order($user_info,$change_money);
            }*/
            return db_func("users","agent_")->update($data);
        }
    }

    private function create_manual_order($user_info,$money){
        $order_id = create_order_num();
        $order_data = array(
            "order_id" => $order_id,
            "name"=> get_admin_name()."修改".$user_info['user_login'].$money."元",
            "pay_status"=>1,
            "status"=>1,
            "uid"=>$user_info['id'],
            "username"=>$user_info['user_login'],
            "order_type"=>2,
            "money"=>$money,
            "create_time"=>time()
        );
        db_func("order_list","agent_")->insert($order_data);
    }

    public function del_agent_user($id){
        return db_func("users","agent_")->where(['id'=>$id])->update(['status'=>"-1"]);
    }

    public function get_card_list($model){
        return db_func("tickets_list l","md_")
            ->field("l.*,u.user_login,u2.username,t.title tickets_name")
            ->join(['users'=>'u',"agent_"],"u.id = l.agent_id","LEFT")
            ->join(["users"=>'u2',"md_"],"u2.id = l.uid","LEFT")
            ->join(['tickets t',"t.id = l.pid","LEFT"])
            ->where($model->wheresql)
            ->order("l.id desc")
            ->paginate(20);
    }

    public function get_agent_recharge_list($model){
        return db_func("order_list","agent_")
            ->where($model->wheresql)
            ->paginate(20);
    }

    public function get_agent_recharge_user_list($post){
        $pay_status = $order_status = $pay_plat = $start = $end = $search_word = null;
        extract($post);
        $cond = [];
        $pay_status && ($cond['o.pay_status'] = $pay_status);
        $cond['o.status']=['neq',-1];
        $cond['o.agent_id']=['neq',0];
        $cond['o.type']="open";
        $pay_plat && ($cond['pay_plat'] = $pay_plat);
        $search_word && ($cond['o.order_id|o.agent_id|u.user_login'] = ['like',"%".$search_word."%"]);
        empty($start) && ($start=0);
        empty($end) && ($start=time());
        return db_func('order_list o', 'md_')
            ->field("o.*,u.user_login")
            ->join(['users'=>'u',"agent_"],"u.id = o.agent_id","LEFT")
            ->where($cond)
            ->order('o.id desc')
            ->paginate(config('pre_page'));
    }

    public function get_card_buy_record($start_time,$end_time,$type,$word){
        $cond = [];
        !empty($start_time) && $cond['b.create_time'] = ['egt',$start_time];
        !empty($end_time) && $cond['b.create_time'] = ['elt',$end_time];
        !empty($type) && $cond['b.type'] = $type;
        !empty($word) && $cond['u.user_login|u.phone'] = ['like',$word];

        return db_func("buy_tickets b","agent_")
            ->field("b.*,u.user_login,u.phone,t.title")
            ->join(["users"=>"u","agent_"],"u.id = b.agent_id","left")
            ->join(['tickets'=>"t","md_"],"t.id = b.tickets_id","left")
            ->where($cond)
            ->order("b.id desc")
            ->paginate(20);
    }

    public function get_card_use_record($word){
        $page = input("param.page",1);
        $cond = [];
        !empty($word) && $cond['user_login|phone'] = ['like',$word];
        $cond['status'] = 1;
        $uids = db_func("users","agent_")->field("SQL_CALC_FOUND_ROWS *")->where($cond)->limit(($page-1)*10,10)->select();
        $uids = array_column($uids,"id");

        $sql = "SELECT FOUND_ROWS() as num";
        $num = db_func("users","agent_")->query($sql);

        //获取该用户们的的卡密列表
        $data =  db_func("users u","agent_")
            ->field("u.user_login,u.phone,u.id,sum(case l.status when '1' then 1 else 0 end) as unuse,sum(case l.status when '-2' then 1 else 0 end) as already_use,count(l.id) all_num")
            ->join(['tickets_list'=>"l","md_"],"u.id = l.agent_id and l.status != -1","left")
            ->where(['u.id'=>['in',$uids]])
            ->group("u.id")
            ->select();

        return ['data'=>$data,"num"=>$num[0]["num"]];
    }

    public function get_son_card_use_record($cond){
        return db_func("tickets_list l","md_")
            ->field("t.title,l.code,l.password,b.type,b.deal_user,u.username,l.create_time,l.use_time")
            ->join(['tickets'=>"t","md_"],"t.id = l.pid","left")
            ->join(['buy_tickets'=>"b","agent_"],"b.id = l.buy_tickets_id","left")
            ->join(['users'=>"u","md_"],"u.id = l.use_id","left")
            ->where($cond)
            ->paginate(20);
    }

    public function get_card_order_record($cond){
        return db_func("tickets_list l","md_")
            ->field("l.create_time,t.title,o.username,u.user_login,o.order_id,o.name,o.money,o.pay_time")
            ->join(['tickets'=>"t","md_"],"t.id = l.pid","left")
            ->join("md_order_list o","o.order_id = l.order_id","left")
            ->join(['users'=>"u",'agent_'],"u.id = l.agent_id","left")
            ->where($cond)
            ->paginate(20);
    }

    public function get_edition_list($post){
        $sql = "SELECT SQL_CALC_FOUND_ROWS *
        FROM  md_edition
        WHERE status = 1 AND " . $post->wheresql .
            " ORDER BY id desc " . $post->limitData;

        $sql_count = "SELECT FOUND_ROWS() as num";

        $user_info = Db::query($sql);
        $num = Db::query($sql_count);

        $rt["data"] = $user_info;
        $rt["count"] = $num[0]["num"];
        return $rt;
    }

}