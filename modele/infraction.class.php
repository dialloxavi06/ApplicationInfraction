<?php
    class Infraction
	{
		private $id;
		private $num_immat;
		private $dateinf;
        private $no_permis;
		


		function __construct(string $id='', string $numImmat='', string $dateinf='', string $nopermis = '') {
			$this->id	    	=$id;
			$this->num_immat		=$numImmat;
			$this->dateinf	=$dateinf;
            $this->no_permis	=$nopermis;
            
		}

		function getId	    	() : string			    { return $this->id;		        	}
		function setId	    	(string $id)			{ $this->id=$id;	        		}
		function getImmatricul 	() : string			    { return $this->num_immat; 			}
		function setImmatricul	(string $immatricul)		{ $this->num_immat=$immatricul; 			}
		function getDateinfract	() : string				{ return $this->dateinf; 		}   
		function setDateinfract	(string $dateinfract)	{ $this->dateinf=$dateinfract;  }		
        function getNopermis	() : string				{ return $this->no_permis; 		}   
		function setNopermis	(string $nopermis)	{ $this->no_permis=$nopermis;  }		
	}
?>