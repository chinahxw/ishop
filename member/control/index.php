<?php
/**
 * 默认展示页面
 *
 *
 * * @ (c) 2015-2018 kelan Inc. (http://官网)
 * @license    http://www.官网
 * @link       交流群号：官网群
 * @since      提供技术支持 授权请购买正版授权
 */



defined('INTELLIGENT_SYS') or exit('Access Invalid!');
class indexControl extends BaseLoginControl{
    public function __construct() {
        @header("location: " . urlMember('member_information'));
    }
}
