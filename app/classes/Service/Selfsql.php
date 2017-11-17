<?php

namespace SelfApp\Service;

use PDO;
use LianzhSQL\Sql;
use LianzhSQL\SqlMS;

/**
 * 数据库服务
 */
final class Selfsql
{

	public function __construct(array $configs)
	{
		SqlMS::init($configs);
	}

	/**
	 * 返回主库对象
	 * 
	 * @return \LianzhSQL\SqlMaster
	 */
	public function sqlMaster()
	{
		return SqlMS::master();
	}

	/**
	 * 返回主库对象
	 * 
	 * @return \LianzhSQL\SqlSlaver
	 */
	public function sqlSlaver()
	{
		return SqlMS::slaver();
	}

	public static function monitor($sql, $dsnId)
	{

	}

}