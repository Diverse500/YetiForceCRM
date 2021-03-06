<?php

/**
 * 
 * @package YetiForce.Views
 * @license licenses/License.html
 * @author Mriusz Krzaczkowski <m.krzaczkowski@yetiforce.com>
 */
class Settings_LoginHistory_ListView_Model extends Settings_Vtiger_ListView_Model
{

	/**
	 * Funtion to get the Login history basic query
	 * @return type
	 */
	public function getBasicListQuery()
	{
		$module = $this->getModule();
		$query = (new App\Db\Query())->select(['login_id', 'user_name', 'user_ip', 'logout_time',
			'login_time', 'vtiger_loginhistory.status'])
			->from($module->baseTable);
		$search_key = $this->get('search_key');
		$value = $this->get('search_value');
		if (!empty($search_key) && !empty($value)) {
			$query->where(["$module->baseTable.$search_key" => $value]);
		}
		$query->orderBy(['login_time' => SORT_DESC]);
		return $query;
	}

	public function getListViewLinks()
	{
		return [];
	}

	/**
	 * Function which will get the list view count  
	 * @return - number of records 
	 */
	public function getListViewCount()
	{
		$query = $this->getBasicListQuery();
		$query->orderBy([]);
		return $query->count();
	}
}
