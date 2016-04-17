<?php
class opmysql {
	private $host = 'localhost'; // 服务器地址
	private $name = 'root'; // 登录账号
	private $pwd = 'root'; // 登录密码
	private $dBase = 'notes'; // 数据库名称
	private $conn = ''; // 数据库链接资源
	private $result = ''; // 结果集
	private $msg = ''; // 返回结果
	private $rowsNum = 0; // 返回结果数
	private $rowsRst = ''; // 返回单条记录的字段数组
	private $filesArray = array (); // 返回字段数组
	private $rowsArray = array (); // 返回结果数组
	                               // 初始化类
	function __construct($host = '', $name = '', $pwd = '', $dBase = '') {
		if ($host != '')
			$this->host = $host;
		if ($name != '')
			$this->name = $name;
		if ($pwd != '')
			$this->pwd = $pwd;
		if ($dBase != '')
			$this->dBase = $dBase;
		$this->init_conn ();
	}
	
	/**
	 * 链接数据库
	 */
	function init_conn() {
		$this->conn = @mysqli_connect ( $this->host, $this->name, $this->pwd );
		@mysqli_select_db ($this->conn, $this->dBase);
		//error_reporting ( E_ALL & ~ E_DEPRECATED );
		mysqli_query ($this->conn, "set names UTF8" );
	}
	
	/**
	 * 查询结果
	 */
	function mysql_query_rst($sql) {
		if ($this->conn == '') {
			$this->init_conn ();
		}
		$this->result = @mysqli_query ($this->conn, $sql);
	}
	
	/**
	 * 取得查询结果条数
	 */
	function getRowsNum($sql) {
		$this->mysql_query_rst ( $sql );
		if (mysqli_errno ($this->conn) == 0) {
			return @mysqli_num_rows ( $this->result );
		} else {
			return '';
		}
	}
	
	/**
	 * 取得记录数组（单条记录）
	 */
	function getRowsRst($sql) {
		$this->mysql_query_rst ( $sql );
		if (mysqli_error ($this->conn) == 0) {
			$this->rowsRst = mysqli_fetch_array ( $this->result, 1 );
			return $this->rowsRst;
		} else {
			return '';
		}
	}
	
	/**
	 * 取得记录数组（多条记录）
	 */
	function getRowsArray($sql) {
		$this->mysql_query_rst ( $sql );
		if (mysqli_errno ($this->conn) == 0) {
			while ( $row = mysqli_fetch_array ( $this->result, 1 ) ) {
				$this->rowsArray [] = $row;
			}
			return $this->rowsArray;
		} else {
			return '';
		}
	}
	
	/**
	 * 更新、删除、添加记录数
	 */
	function uidRst($sql) {
		if ($this->conn == '') {
			$this->init_conn ();
		}
		@mysqli_query ($this->conn, $sql );
		$this->rowsNum = @mysqli_affected_rows ($this->conn);
		if (mysqli_errno ($this->conn) == 0) {
			return $this->rowsNum;
		} else {
			return '';
		}
	}
	
	/**
	 * 错误信息
	 */
	function msg_error() {
		if (mysqli_errno ($this->conn) != 0) {
			$this->msg = mysqli_error ($this->conn);
		}
		return $this->msg;
	}
	
	/**
	 * 释放结果集
	 */
	function close_rst() {
		@mysqli_free_result ( $this->result );
		$this->msg = '';
		$this->rowsNum = 0;
		$this->filesArray = '';
		$this->rowsArray = '';
	}
	
	/**
	 * 关闭数据库
	 */
	function close_conn() {
		$this->close_rst ();
		@mysqli_close ( $this->conn );
		$this->conn = '';
	}
}
$conn = new opmysql ();
?>