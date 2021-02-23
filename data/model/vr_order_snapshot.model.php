<?php
/**
 * 交易快照
 *
 *
 *
 * * @ (c) 2015-2018 kelan Inc. (http://官网)
 * @license    http://www.官网
 * @link       交流群号：官网群
 * @since      提供技术支持 授权请购买正版授权
 */
defined('INTELLIGENT_SYS') or exit('Access Invalid!');
class vr_order_snapshotModel extends Model {

    public function __construct() {
        parent::__construct('vr_order_snapshot');
    }

    /**
     * 由订单商品表主键取得交易快照信息
     * @param int $order_id
     * @param int $goods_id
     * @return array
     */
    public function getSnapshotInfoByOrderid($order_id,$goods_id) {
        $info = $this->where(array('order_id'=>$order_id))->find();
        if (!$info) {
            return $this->createSphot($order_id, $goods_id);
        }
        return $info;
    }

    public function createSphot($order_id,$goods_id) {
        $model_goods = Model('goods');
        $goods_info = $model_goods->getGoodsInfo(array('goods_id'=>$goods_id),'goods_serial,goods_body,goods_commonid');
        $goods_common_info = $model_goods->getGoodsCommonInfo(array('goods_commonid'=>$goods_info['goods_commonid']),'brand_name,goods_attr,goods_body,plateid_top,plateid_bottom');
        $goods_common_info['goods_attr'] = unserialize($goods_common_info['goods_attr']);
        $_attr = array();
        $_attr['货号'] = $goods_info['goods_serial'];
        $_attr['品牌'] = $goods_common_info['brand_name'];
        if (is_array($goods_common_info['goods_attr']) && !empty($goods_common_info['goods_attr'])) {
            foreach($goods_common_info['goods_attr'] as $v) {
                $_attr[$v['name']] = end($v);
            }            
        }

        $info = array();
        $info['order_id'] = $order_id;
        $info['goods_id'] = $goods_id;
        $info['create_time'] = time();
        $info['goods_attr'] = serialize($_attr);
        $info['goods_body'] = $goods_info['goods_body'] == '' ? $goods_common_info['goods_body'] : $goods_info['goods_body'];
        $model_plate = Model('store_plate');
        // 顶部关联版式
        if ($goods_common_info['plateid_top'] > 0) {
            $plate_top = $model_plate->getStorePlateInfoByID($goods_common_info['plateid_top']);
            $info['plate_top'] = $plate_top['plate_content'];
        }
        // 底部关联版式
        if ($goods_common_info['plateid_bottom'] > 0) {
            $plate_bottom = $model_plate->getStorePlateInfoByID($goods_common_info['plateid_bottom']);
            $info['plate_bottom'] = $plate_bottom['plate_content'];
        }
        $this->insert($info);
        return $info;
    }

}
