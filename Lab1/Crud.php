<?php
	interface Crud{
		public function save($con);
		public function readAll($con);
		public function readUnique();
		public function search();
		public function update();
		public function removeOne();
		public function removeAll();

		//added for lab2
		public function validateForm();
		public function createFormErrorSessions();
	}

?>