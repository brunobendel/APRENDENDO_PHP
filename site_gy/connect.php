<?php 

function connect_mysql($sql){
$bd_host  	= 'localhost';		//Host do Banco de Dados
$bd_user  	= 'root';			//Usuário do Banco de Dados
$bd_senha 	= "";				//Senha do Banco de Dados
$bd 	= 'ts2';				//Banco de Dados
if ($sql=="") { die('SQL Query not found'); }
$con = mysql_connect($bd_host,$bd_user,$bd_senha);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($bd, $con);
$result = mysql_query($sql);

return $result;
mysql_close($con);
}





//CONEXAO
function connect($sql){

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


//CONEXAO AMBIENTE DE TESTES
function connect_teste($sql)
{
$bd_user  	= 'TS2';			//Usuário do Banco de Dados
$bd_senha 	= 'oUpukUipPYMQpLa';			//Senha do Banco de Dados
$bd ="(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 10.104.129.13)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SERVICE_NAME = ORAT)
    )
  )";

if ($sql=="") { exit; }
if(!$conn = oci_connect($bd_user,$bd_senha,$bd)) { exit; }
if(!$stmt = oci_parse($conn, $sql)) { exit; }
oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
OCICommit($conn);

return $stmt;

oci_free_statement($stmt);
oci_close($conn);

}





function connect_goodface($sql){
$bd_user  	= 'GOODFACE';			//Usuário do Banco de Dados
$bd_senha 	= 'KNFOQGZf3j8Lefc';		//Senha do Banco de Dados
$bd ="(DESCRIPTION =
     (ADDRESS =
         (PROTOCOL = TCP)
         (HOST = 10.104.129.13)
         (PORT = 1521)
     )
   (CONNECT_DATA = (SID = ORA))
  )";

if ($sql=="") { exit; }
if(!$conn = oci_connect($bd_user,$bd_senha,$bd)) { exit; }
if(!$stmt = oci_parse($conn, $sql)) { exit; }
oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
OCICommit($conn);

return $stmt;

oci_free_statement($stmt);
oci_close($conn);
}



function connect_sbs_pass($sql){
$bd_user  	= 'gsreads';			//Usuário do Banco de Dados
$bd_senha 	= 'we5I6ZknFVXAOFZ';		//Senha do Banco de Dados
$bd ="(DESCRIPTION =
     (ADDRESS =
         (PROTOCOL = TCP)
         (HOST = BRASBS01)
         (PORT = 1521)
     )
   (CONNECT_DATA = (SID = ORA))
  )";

if ($sql=="") { exit; }
if(!$conn = oci_connect($bd_user,$bd_senha,$bd)) { exit; }
if(!$stmt = oci_parse($conn, $sql)) { exit; }
oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
OCICommit($conn);

return $stmt;

oci_free_statement($stmt);
oci_close($conn);
}

function connect_sbs_mrt($sql){
$bd_user  	= 'gsreads';			//Usuário do Banco de Dados
$bd_senha 	= 'we5I6ZknFVXAOFZ';		//Senha do Banco de Dados
$bd ="(DESCRIPTION =
     (ADDRESS =
         (PROTOCOL = TCP)
         (HOST = BRAA3SBS)
         (PORT = 1521)
     )
   (CONNECT_DATA = (SID = ORA))
  )";

if ($sql=="") { exit; }
if(!$conn = oci_connect($bd_user,$bd_senha,$bd)) { exit; }
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
      (ADDRESS = (PROTOCOL = TCP)(HOST = br02sp02d)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SERVICE_NAME = PCF)
    )
  )";

if ($sql=="") { exit; }
if(!$conn = oci_connect($bd_user,$bd_senha,$bd)) { exit; }
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

//CONEXAO BRFAM
function connect_brfam($sql)
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

	if ($sql=='') { exit; }
	if(!$conn = oci_connect($bd_user,$bd_senha,$bd,"UTF8")) { exit; }
	if(!$stmt = oci_parse($conn, $sql)) { exit; }
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

?>
