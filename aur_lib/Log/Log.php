<?php

/**
 * ログ作成クラス
 */

class Log {
    private $pathDirectory;
    private $filename;

    /**
     * ファイル名を格納
     * @param string $filename
     */
    public function setFilename($filename) {
        $this->filename = $filename;
    }

    /**
     * アップロードディレクトリのファイルパスを格納
     * @param string $pathDirectory
     */
    public function setPathDirectory($pathDirectory) {
        $this->pathDirectory = $pathDirectory;
    }
    
    /**
     * ファイル名を取得
     * @return string
     */
    public function getFilename() {
        return $this->filename;
    }
    
    /**
     * アップロードディレクトリのファイルパスを取得
     * @return string
     */
    public function getPathDirectory() {
        return $this->pathDirectory;
    }

    /**
     * ログを保存するディレクトリを作成
     * @return bool
     */
    public function makeLogDirectory($pathDirectory) {
        $result = false;

        $this->pathDirectory = $pathDirectory;

        if (!file_exists($pathDirectory)) {
            if (mkdir($pathDirectory,0777)) {
                // パーミッション
                chmod($pathDirectory,0777);
                // htaccessファイルを作成
                $htaccess_file = '.htaccess';
                $htaccess_data = 'deny from All';
                $htaccess_path = $pathDirectory.'/'.$htaccess_file;
                
                if ($file = fopen($htaccess_path, "w") ) {
                    fwrite($file, $htaccess_data);
                    fclose($file);
                }
                $result = true;
            } 
        }
        return $result;
    }

    /**
     * ログファイルの作成
     * @return bool
     */
    public function makeLog($message) {
        $result = false;

        if ($this->pathDirectory) {
            # ディレクトリの存在チェック、なければディレクトリを作成
            if (!file_exists($this->pathDirectory)) $this->makeLogDirectory($this->pathDirectory);

            $pathLog = $this->pathDirectory.'/'.$this->filename;
            if ($file = fopen($pathLog, "a")) {
                $result = fwrite($file, $message);
                $result = fclose($file);
            }
        }
        
        return $result;
    }

    /**
     * ログファイルを削除
     * @return bool
     */
    public function deleteLog() {
        $result = false;

        $filename = $this->filename;
        $path_log = $this->pathDirectory.'/'.$filename;

        if (file_exists($path_log)) $result = unlink($path_log);

        return $result;
    }
}
