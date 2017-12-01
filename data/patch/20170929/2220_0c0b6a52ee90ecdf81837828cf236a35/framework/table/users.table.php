<?php
/**
 * [WeEngine System] Copyright (c) 2014 WE7.CC
 * WeEngine is NOT a free software, it under the license terms, visited http://www.we7.cc/ for more details.
 */

defined('IN_IA') or exit('Access Denied');

class UsersTable extends We7Table {

	public function searchUsersList() {
		global $_W;
		$this->query->from('users', 'u')
				->select('u.*, p.avatar as avatar')
				->leftjoin('users_profile', 'p')
				->on(array('u.uid' => 'p.uid'))
				->orderby('uid', 'DESC');
		if (user_is_vice_founder()) {
			$this->query->where('u.owner_uid', $_W['uid']);
		}
		return $this->query->getall();
	}

	
	public function userOwnedAccount($uid) {
		$uniacid_list = $this->query->from('uni_account_users')->where('uid', $uid)->getall('uniacid');
		return array_keys($uniacid_list);
	}

	public function userOwnedAccountRole($uid, $uniacid = 0) {
		if (empty($uniacid)) {
			$role = $this->query->from('uni_account_users')->where('uid', $uid)->getall('role');
			return array_keys($role);
		} else {
			$role = $this->query->from('uni_account_users')->where(array('uid' => $uid, 'uniacid' => $uniacid))->get();
			return $role['role'];
		}
	}

	public function userPermission($uid, $uniacid) {
		return $this->query->from('users_permission')->where('uid', $uid)->where('uniacid', $uniacid)->getall('type');
	}

	public function searchWithStatus($status) {
		$this->query->where('u.status', $status);
		return $this;
	}

	public function searchWithType($type) {
		$this->query->where('u.type', $type);
		return $this;
	}

	public function searchWithFounder($founder_groupids) {
		$this->query->where('u.founder_groupid', $founder_groupids);
		return $this;
	}

	public function searchWithName($user_name) {
		$this->query->where('u.username LIKE', "%{$user_name}%");
		return $this;
	}

	public function searchWithOwnerUid($owner_uid) {
		$this->query->where('u.owner_uid', $owner_uid);
		return $this;
	}

	public function accountUsersNum($uid) {
		return $this->query->from('uni_account_users')->where('uid', $uid)->count();
	}

	public function usersGroup() {
		return $this->query->from('users_group')->getall('id');
	}

	public function usersFounderGroup() {
		return $this->query->from('users_founder_group')->getall('id');
	}
}