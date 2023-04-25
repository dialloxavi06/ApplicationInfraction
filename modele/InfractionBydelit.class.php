
<?php
	require_once("infraction.class.php");
	require_once("delit.class.php");

    class InfractionBydelit
	{
		private $_idDelit;
		private $_idInf;
		

		function __construct(Delit $idDelit=null, Infraction $idInf= null) {
			$this->_idDelit=$idDelit;
			$this->_idInf = $idInf;	
 
		}

		function getDelit	  () : Delit			    { return $this->_idDelit;		        	}
		function setDelit	  (string $id)			{ $this->_idDelit=$id;	        		}
		function getInf 	() : Infraction			    { return $this->_idInf; 			}
		function setInf	(string $idInf)		{ $this->_idInf=$idInf; 			}
			
		
		
	}
