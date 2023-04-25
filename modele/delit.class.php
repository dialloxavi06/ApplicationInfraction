<?php
    class Delit
	{
		private $id_delit;
		private $nature;
		private $montant;

		function __construct (string $id_delit='', string $nature='', float $montant=0) {
			$this->id_delit	    	=$id_delit;
			$this->nature		=$nature;
			$this->montant	=$montant;
		}

		function getId_delit	    	() : string			    { return $this->id_delit;		        	}
		function setId_delit	    	(string $id_delit)			{ $this->id_delit=$id_delit;	        		}
		function getNature 	() : string			    { return $this->nature; 			}
		function setNature 	(string $nature)		{ $this->nature=$nature; 			}
		function getMontant	() : float				{ return $this->montant; 		}   
		function setMontant	(string $montant)	{ $this->montant=$montant;  }		
	}
