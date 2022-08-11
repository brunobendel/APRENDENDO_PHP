<?php

//CONEXAO BR_PPP
function connect_brppp($sql){

	/* ORACLE */
	$bd_user  	= 'BR_PPP';			//Usuário do Banco de Dados
	$bd_senha 	= '2lyUkoDVqAO2IA9';		//Senha do Banco de Dados
	$bd ="(DESCRIPTION =
		(ADDRESS_LIST =
		  (ADDRESS = (PROTOCOL = TCP)(HOST = 10.104.129.13)(PORT = 1521))
		)
		(CONNECT_DATA =
		  (SERVICE_NAME = ORA)
		)
	  )";

	if ($sql=="") { exit; }
	if(!$conn = oci_connect($bd_user,$bd_senha,$bd,'UTF8')) { exit; }
	if(!$stmt = oci_parse($conn, $sql)) { exit; }
	oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
	OCICommit($conn);

	return $stmt;

	oci_free_statement($stmt);
	oci_close($conn);
	}
	
	function connect_brfam($sql1)
	{	
	$bd_user  	= 'BR_FAM';			//Usuário do Banco de Dados
	$bd_senha 	= 'KIaVk9x3qna4re5';		//Senha do Banco de Dados
	$bd ="(DESCRIPTION =
		(ADDRESS_LIST =
		  (ADDRESS = (PROTOCOL = TCP)(HOST = 10.104.129.13)(PORT = 1521))
		)
		(CONNECT_DATA =
		  (SERVICE_NAME = ORA)
		)
	  )";

	if ($sql1=='') { exit; }
	if(!$conn = oci_connect($bd_user,$bd_senha,$bd,"UTF8")) { exit; }
	if(!$stmt = oci_parse($conn, $sql1)) { exit; }
	oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
	OCICommit($conn);

	return $stmt;

	oci_free_statement($stmt);
	oci_close($conn);
	}
	
	
	function connect_divb2($sql)
	{
	$bd_user  	= 'BR_DIVB2';			//Usuário do Banco de Dados
	$bd_senha 	= 'a4re77IaVk9xAqn';		//Senha do Banco de Dados
	$bd ="(DESCRIPTION =
		(ADDRESS_LIST =
		  (ADDRESS = (PROTOCOL = TCP)(HOST = 10.104.129.13)(PORT = 1521))
		)
		(CONNECT_DATA =
		  (SERVICE_NAME = ORA)
		)
	  )";

	if ($sql=='') { exit; }
	if(!$conn = oci_connect($bd_user,$bd_senha,$bd,"UTF8")) { exit; }
	if(!$stmt = oci_parse($conn, $sql)) { exit; }
	oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
	OCICommit($conn);

	return $stmt;

	oci_free_statement($stmt);
	oci_close($conn);
	}
	
	//CONEXAO PCF
	function connect_pcf($sql)
	{
	$bd_user  	= 'LDA3820';			//Usuário do Banco de Dados
	$bd_senha 	= 'TdOY5dKJg4HfVpi';		//Senha do Banco de Dados
	$bd ="(DESCRIPTION =
		(ADDRESS_LIST =
		  (ADDRESS = (PROTOCOL = TCP)(HOST = br02sp01d)(PORT = 1521))
		)
		(CONNECT_DATA =
		  (SERVICE_NAME = PCF)
		)
	  )";

	if ($sql=='') { exit; }
	if(!$conn = oci_connect($bd_user,$bd_senha,$bd)) { exit; }
	if(!$stmt = oci_parse($conn, $sql)) { exit; }
	oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
	OCICommit($conn);

	return $stmt;

	oci_free_statement($stmt);
	oci_close($conn);
	}	
	
	function connect_ts2($sql)
	{
		
		$bd_user  	= 'TS2';			//Usuário do Banco de Dados
		$bd_senha 	= 'oUpukUipPYMQpLa';			//Senha do Banco de Dados
		$bd ="(DESCRIPTION =
			(ADDRESS_LIST =
			  (ADDRESS = (PROTOCOL = TCP)(HOST = 10.104.129.13)(PORT = 1521))
			)
			(CONNECT_DATA =
			  (SERVICE_NAME = ORA)
			)
		  )";

		if ($sql=='') { exit; }
		if(!$conn = oci_connect($bd_user,$bd_senha,$bd,'UTF8')) { exit; }
		if(!$stmt = oci_parse($conn, $sql)) { exit; }
		oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
		OCICommit($conn);

		return $stmt;

		oci_free_statement($stmt);
		oci_close($conn);

	}
	
	
	
	//CONEXAO INVSYS
	function connect_inv($sql){

	/* ORACLE */
	$bd_user  	= 'INVENTARIO';			//Usuário do Banco de Dados
	$bd_senha 	= 'R1ZBEOsDkPbFWGh';		//Senha do Banco de Dados
	$bd ="(DESCRIPTION =
		(ADDRESS_LIST =
		  (ADDRESS = (PROTOCOL = TCP)(HOST = 10.104.129.13)(PORT = 1521))
		)
		(CONNECT_DATA =
		  (SERVICE_NAME = ORA)
		)
	  )";

	if ($sql=="") { exit; }
	if(!$conn = oci_connect($bd_user,$bd_senha,$bd,'UTF8')) { exit; }
	if(!$stmt = oci_parse($conn, $sql)) { exit; }
	oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
	OCICommit($conn);

	return $stmt;

	oci_free_statement($stmt);
	oci_close($conn);
	}
	
	
	
	
	//CONEXAO BLADDERLIFE
	function connect_bladderlife($sql)
	{
	$bd_user  	= 'bladderlife';	//Usuário do Banco de Dados
	$bd_senha 	= 'bHeG72Vw8GJQA9C';		//Senha do Banco de Dados
	$bd ="
		(DESCRIPTION =
		(ADDRESS_LIST =
		(ADDRESS = (PROTOCOL = TCP)(HOST = 10.104.129.13)(PORT = 1521))
		)
		(CONNECT_DATA =
		(SERVICE_NAME = ORA)
		)
		)
	";

	if ($sql=="") { exit; }
	if(!$conn = oci_connect($bd_user,$bd_senha,$bd)) { exit; }
	if(!$stmt = oci_parse($conn, $sql)) { exit; }
	oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
	OCICommit($conn);

	return $stmt;

	oci_free_statement($stmt);
	oci_close($conn);

	}
	
	
	
	function connect_milling($sql)
	{
	$bd_user  	= 'MILLING';			//Usuário do Banco de Dados
	$bd_senha 	= 'qXvZHVqCG70fNti';			//Senha do Banco de Dados
	$bd ="(DESCRIPTION =
		(ADDRESS_LIST =
		  (ADDRESS = (PROTOCOL = TCP)(HOST = 10.104.129.13)(PORT = 1521))
		)
		(CONNECT_DATA =
		  (SERVICE_NAME = ORA)
		)
	  )";

	if ($sql=='') { exit; }
	if(!$conn = oci_connect($bd_user,$bd_senha,$bd, 'UTF8')) { exit; }
	if(!$stmt = oci_parse($conn, $sql)) { exit; }
	oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
	OCICommit($conn);

	return $stmt;

	oci_free_statement($stmt);
	oci_close($conn);

	}
	
	
	
	
	function connect_mrt($sql)
	{
	$bd_user  	= 'gsreads';			//Usuário do Banco de Dados
	$bd_senha 	= 'we5I6ZknFVXAOFZ';			//Senha do Banco de Dados
	$bd ="(DESCRIPTION =
		(ADDRESS_LIST =
		  (ADDRESS = (PROTOCOL = TCP)(HOST = bramrt01)(PORT = 1521))
		)
		(CONNECT_DATA =
		  (SERVICE_NAME = ORA)
		)
	  )";

	if ($sql=='') { exit; }
	if(!$conn = oci_connect($bd_user,$bd_senha,$bd, 'UTF8')) { exit; }
	if(!$stmt = oci_parse($conn, $sql)) { exit; }
	oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
	OCICommit($conn);

	return $stmt;

	oci_free_statement($stmt);
	oci_close($conn);

	}
	
	
	
	
	
	function connect_n2($sql){
	$bd_user  	= 'gsreads';			//Usuário do Banco de Dados
	$bd_senha 	= 'we5I6ZknFVXAOFZ';		//Senha do Banco de Dados
	$bd ="(DESCRIPTION =
		 (ADDRESS =
			 (PROTOCOL = TCP)
			 (HOST = brarpt1)
			 (PORT = 1521)
		 )
	   (CONNECT_DATA = (SID = ORA))
	  )";

	if ($sql=='') { exit; }
	if(!$conn = oci_connect($bd_user,$bd_senha,$bd,"UTF8")) { exit; }
	if(!$stmt = oci_parse($conn, $sql)) { exit; }
	oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
	OCICommit($conn);

	return $stmt;

	oci_free_statement($stmt);
	oci_close($conn);
}



function connect_oee($sql)
{
    $bd_user  	= 'OEE_AM';			//Usuário do Banco de Dados
    $bd_senha 	= 'L8thXb83fOV0asb';		//Senha do Banco de Dados
    $bd ="(DESCRIPTION =
			 (ADDRESS =
				 (PROTOCOL = TCP)
				 (HOST = 10.104.129.13)
				 (PORT = 1521)
			 )
		   (CONNECT_DATA = (SID = ORA))
		  )";

    if ($sql=='') { exit; }
    if(!$conn = oci_connect($bd_user,$bd_senha,$bd,"UTF8")) { exit; }
    if(!$stmt = oci_parse($conn, $sql)) { exit; }
    oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
    //oci_execute($stmt);$num = oci_num_rows($stmt);var_dump($stmt);exit;
    OCICommit($conn);
    return $stmt;
    oci_free_statement($stmt);
    oci_close($conn);
}



function connect_poam($sql){
    $bd_user  	= 'POAM';			//Usu�rio do Banco de Dados
    $bd_senha 	= 'JgVfnbis1WqeWYR';		//Senha do Banco de Dados
    $bd ="(DESCRIPTION =
			 (ADDRESS =
				 (PROTOCOL = TCP)
				 (HOST = 10.104.129.13)
				 (PORT = 1521)
			 )
		   (CONNECT_DATA = (SID = ORA))
		  )";

    if ($sql=='') { exit; }
    if(!$conn = oci_connect($bd_user,$bd_senha,$bd,'utf8')) { exit; }
    if(!$stmt = oci_parse($conn, $sql)) { exit; }
    oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
    OCICommit($conn);
    return $stmt;
    oci_free_statement($stmt);
    oci_close($conn);
}


?>