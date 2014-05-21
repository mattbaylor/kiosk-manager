<?php
class proc_fix extends HyperDB {
    function call_proc($procName) {
        $result = $this->get_results("CALL $procName();", ARRAY_A);
		$this->get_results("SELECT 1");
		return($result);
    }
}
?>