<?php
class BDD extends PDO
{
  function __construct()
	{
		$user = "";
        $passwd = ""; 
		
		try
		{
			parent::__construct($this->fabriquerChaineConnexPDO(),$user,$passwd);
		}
		catch (PDOException $erreur)
		{
			echo $erreur->getMessage();
		}
	}


	function majDonneesPDO($sql)
	{
		$res = $this->exec($sql);
		return $res;
	}

	function preparerRequetePDO($sql)
  {
		$cur = $this->prepare($sql);
		return $cur;
	}

	function ajouterParamPDO($cur,$param,$contenu,$type='texte',$taille=0) // fonctionne avec preparerRequete
	{
		$cur->bindParam($param, $contenu);
		return $cur;
	}

	function majDonneesPrepareesPDO($cur)
	{
		$res = $cur->execute();
		return $res;
	}

	function majDonneesPrepareesTabPDO($cur,$tab) // fonctionne directement après preparerRequete
	{
		$res = $cur->execute($tab);
		return $res;
	}

	function LireDonneesPDO1($sql,&$tab)
	{
		$i=0;
		foreach  ($this->query($sql,PDO::FETCH_ASSOC) as $ligne)
			$tab[$i++] = $ligne;
		$nbLignes = $i;
		return $nbLignes;
	}

	function LireDonneesPDO2($sql,&$tab)
	{
		$i=0;
		$cur = $this->query($sql);
		while ($ligne = $cur->fetch(PDO::FETCH_ASSOC))
			$tab[$i++] = $ligne;
		$nbLignes = $i;
		return $nbLignes;
	}

	function LireDonneesPDO3($sql,&$tab)
	{
		$cur = $this->query($sql);
		$tab = $cur->fetchall(PDO::FETCH_ASSOC);
		return count($tab);
	}

	function LireDonneesPDOPreparee($cur)
	{
	  $res = $cur->execute();
	  $tab = $cur->fetchall(PDO::FETCH_ASSOC);
	  return $tab;
	}

	function fabriquerChaineConnexPDO(){
		$dsn = "sqlsrv:Server=localhost,49676;Database=budget";  //dbname : base de données
        return $dsn;
	}

}

?>
