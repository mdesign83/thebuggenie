<?php

	/**
	 * Components table
	 *
	 * @author Daniel Andre Eikeland <zegenie@zegeniestudios.net>
	 ** @version 3.0
	 * @license http://www.opensource.org/licenses/mozilla1.1.php Mozilla Public License 1.1 (MPL 1.1)
	 * @package thebuggenie
	 * @subpackage tables
	 */

	/**
	 * Components table
	 *
	 * @package thebuggenie
	 * @subpackage tables
	 */
	class TBGComponentsTable extends TBGB2DBTable 
	{

		const B2DBNAME = 'components';
		const ID = 'components.id';
		const SCOPE = 'components.scope';
		const NAME = 'components.name';
		const VERSION_MAJOR = 'components.version_major';
		const VERSION_MINOR = 'components.version_minor';
		const VERSION_REVISION = 'components.version_revision';
		const PROJECT = 'components.project';
		const LEAD_BY = 'components.assigned_to';
		const LEAD_TYPE = 'components.assigned_type'; // v2 backwards compat
		
		public static function getTable()
		{
			return B2DB::getTable('TBGComponentsTable');
		}

		public function __construct()
		{
			parent::__construct(self::B2DBNAME, self::ID);
			parent::_addVarchar(self::NAME, 100);
			parent::_addInteger(self::VERSION_MAJOR, 3);
			parent::_addInteger(self::VERSION_MINOR, 3);
			parent::_addInteger(self::VERSION_REVISION, 5);
			parent::_addForeignKeyColumn(self::PROJECT, TBGProjectsTable::getTable(), TBGProjectsTable::ID);
			parent::_addForeignKeyColumn(self::SCOPE, TBGScopesTable::getTable(), TBGScopesTable::ID);
			parent::_addInteger(self::LEAD_BY, 10);
			parent::_addInteger(self::LEAD_TYPE, 2);
		}
		
		public function getByProjectID($project_id)
		{
			$crit = $this->getCriteria();
			$crit->addWhere(self::PROJECT, $project_id);
			$res = $this->doSelect($crit);
			return $res;
		}
		
	}
