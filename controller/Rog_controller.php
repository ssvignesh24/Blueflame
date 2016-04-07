<?php
	class RogController extends Controller{
		public function subscribe(){
			if($this->is_valid_request()){
				$data = $this->getData();
				$id_ = Subscribe::insert(array(
						"email" => $data['email']
					));
				if($id_ == -1) echo -1;
				elseif($id_ == false) echo 0;
				else echo 1;
			}else{
				$this->showErrors();
			}
		}
	}
?>