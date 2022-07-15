<?php
class CrudHelpers {
    public static function CF_encode_json($arr) {
        $str = json_encode( $arr );
        $enc = base64_encode($str );
        $enc = strtr( $enc, 'poligamI123456', '123456poligamI');
        return $enc;
    }
      
    public static function CF_decode_json($str) {
        $dec = strtr( $str , '123456poligamI', 'poligamI123456');
        $dec = base64_decode( $dec );
        $obj = json_decode( $dec ,true);
        return $obj;
    }

    public static function langOption()
	{
		$path = base_path().'/resources/lang/';
		$lang = scandir($path);

		$t = array();
		foreach($lang as $value) {
			if($value === '.' || $value === '..') {continue;} 
				if(is_dir($path . $value))
				{
					$fp = file_get_contents($path . $value.'/info.json');
					$fp = json_decode($fp,true);
					$t[] =  $fp ;
				}	
			
		}	
		return $t;
	}

    public static function _sort($a, $b) {
	 
		if ($a['sortlist'] == $a['sortlist']) {
		return strnatcmp($a['sortlist'], $b['sortlist']);
		}
		return strnatcmp($a['sortlist'], $b['sortlist']);
	}
}