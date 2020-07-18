<?php
    class FileUploader{
        /*Member Variables*/
        private static $target_directory = "uploads/";
        private static $size_limit = 50000; /*Size given in bytes */
        private $uploadOk = true;
        private $file_original_name;
        private $file_type;
        private $file_size;
        private $final_file_name;
        public $status;

        /*setters and getters */
        public function setOriginalName($file_original_name){
			$this->file_original_name = $file_original_name; 
		}
		public function getOriginalName(){
			return $this->file_original_name; 
		}
		public function setFileType($file_type){
			$this->file_type = $file_type; 
		}
		public function getFileType(){
			return $this->file_type; 
		}
		public function setFileSize($file_size){
			$this->file_size = $file_size; 
		}
		public function getFileSize(){
			return $this->file_size; 
		}
		public function setFinalFileName($final_file_name){
			$this->final_file_name = $final_file_name; 
		}
		public function getFinalFileName(){
			return $this->final_file_name; 
        }
        
        /**methods */
        public function uploadFile($target_file){
            //Get file original name
            $this->file_original_name = $target_file["name"];
            //$this->final_file_name
            $this->saveFilePathTo($target_file);
            //Get file type
            $this->file_type = strtolower(pathinfo($this->final_file_name,PATHINFO_EXTENSION));
            //Get file size
            $this->file_size = $target_file["size"];

            //Calling functions now
            if($this->fileWasSelected($target_file)){
                $this->status = "cool";
                $this->fileAlreadyExists();
                $this->fileSizeIsCorrect();
                $this->fileTypeIsCorrect();
                $this->moveFile($target_file);
            }

            if($this->uploadOk){
                return true;
            }
            else{
                return false;
            }
           
        }
        public function fileAlreadyExists(){
            // Check if file already exists
            if (file_exists($this->final_file_name)) {
                $this->uploadOk = false;
            }
        }
        public function saveFilePathTo(){
            //$this->final_file_name
            $this->final_file_name = self::$target_directory . basename($this->file_original_name);
        }
        public function moveFile($target_file){
            if($this->uploadOk){
                if (move_uploaded_file($target_file["tmp_name"], $this->final_file_name)) {
                    //do nothing as $this->uploadOk = true already
                    $this->status = "ok";
                } 
                else {
                    $this->uploadOk = false;
                    $this->status = $this->file_original_name;              
                }
            }
        }
        public function fileTypeIsCorrect(){
            // Allow certain file formats
            if($this->file_type != "jpg" && $this->file_type != "png" && $this->file_type != "jpeg"
                && $this->file_type != "gif" ) {
                    $this->uploadOk = false;             
                }
        }
        public function fileSizeIsCorrect(){
            // Check file size
            if ($this->file_size > self::$size_limit) {
                $this->uploadOk = false;           
            }
        }
        public function fileWasSelected($target_file){
            if(count($target_file) == 0){
                $this->uploadOk = false;  
                return false;         
            }
            else{
                return true;
            }
        }
        
    }
?>