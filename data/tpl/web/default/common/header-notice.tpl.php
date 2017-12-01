<?php defined('IN_IA') or exit('Access Denied');?><li class="dropdown msg">
	<a href="javascript:;" class="dropdown-toogle" data-toggle="dropdown"><span class="wi wi-bell"><?php  if(!empty($message_notice['total'])) { ?><span class="badge"><?php  echo $message_notice['total'];?></span><?php  } ?></span>消息</a>
	<div class="dropdown-menu">
		<div class="clearfix top">消息<a href="<?php  echo url('message/notice')?>" class="pull-right">查看更多</a></div>
		<div class="msg-list-container">
			<div class="msg-list">
				<?php  if(is_array($message_notice['lists'])) { foreach($message_notice['lists'] as $message_notice_list) { ?>
				<div class="item">
					<div class="info clearifx">
						<div class="pull-right date"><?php  echo date('Y-m-d H:i:s', $message_notice_list['create_time'])?></div>
						<?php  if($message_notice_list['type']==MESSAGE_ORDER_TYPE) { ?>来自 <span>订单消息</span><?php  } ?>
						<?php  if($message_notice_list['type']==MESSAGE_ACCOUNT_EXPIRE_TYPE) { ?>来自 <span>过期消息</span><?php  } ?>
						<?php  if($message_notice_list['type']==MESSAGE_REGISTER_TYPE) { ?>来自 <span>注册消息</span><?php  } ?>
					</div>
					<div class="msg-content">
						<?php  if($message_notice_list['type']==MESSAGE_ORDER_TYPE) { ?><a href="<?php  echo url('site/entry/orders', array('m' => 'store', 'direct'=>1, 'message_id' => $message_notice_list['id']))?>"><?php  echo $message_notice_list['message'];?></a><?php  } ?>
						<?php  if($message_notice_list['type']==MESSAGE_ACCOUNT_EXPIRE_TYPE) { ?><a href="<?php  echo url('account/manage', array('account_type' => ACCOUNT_TYPE_OFFCIAL_NORMAL, 'message_id' => $message_notice_list['id']))?>"><?php  echo $message_notice_list['message'];?></a><?php  } ?>
						<?php  if($message_notice_list['type']==MESSAGE_WECHAT_EXPIRE_TYPE) { ?><a href="<?php  echo url('account/manage', array('account_type' => ACCOUNT_TYPE_APP_NORMAL, 'message_id' => $message_notice_list['id']))?>"><?php  echo $message_notice_list['message'];?></a><?php  } ?>
						<?php  if($message_notice_list['type']==MESSAGE_REGISTER_TYPE && $message_notice_list['status']==USER_STATUS_CHECK) { ?><a href="<?php  echo url('user/display', array('type' => 'check', 'message_id' => $message_notice_list['id']))?>"><?php  echo $message_notice_list['message'];?></a><?php  } ?>
						<?php  if($message_notice_list['type']==MESSAGE_REGISTER_TYPE && $message_notice_list['status']!=USER_STATUS_CHECK) { ?><a href="<?php  echo url('user/display', array('message_id' => $message_notice_list['id']))?>"><?php  echo $message_notice_list['message'];?></a><?php  } ?>
					</div>
				</div>
				<?php  } } ?>
			</div>
		</div>
	</div>
</li>