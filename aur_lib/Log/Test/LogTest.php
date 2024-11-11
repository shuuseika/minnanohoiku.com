<?php
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

require_once('aur_lib/Log/Log.php');

class LogTest extends PHPUnit\Framework\TestCase {
    /**
     * @var Log
    */
    private static $Log;
    private $vfs;

    /**
     * テスト実行前の処理
    **/
    public static function setUpBeforeClass() {
        self::$Log = new Log;
        echo "Create Log Instance\n";
    }

    /**
     * テストメソッド実行前の処理
     */
    public function setUp() {
        self::$Log->setFilename('');
        self::$Log->setPathDirectory('');

        $this->vfs = vfsStream::setup('rootdir');
        //echo $this->vfs->url('rootdir');
    }

    /**
     * ファイル名の格納、取得
     * @test
     */
    public function filename() {
        self::$Log->setFilename('test-filename');
        $this->assertSame('test-filename', self::$Log->getFilename());
    }

    /**
     * ディレクトリパスの格納、取得
     * @test
     */
    public function pathDirectory() {
        self::$Log->setPathDirectory('test-pathDirectory');
        $this->assertSame('test-pathDirectory', self::$Log->getPathDirectory());
    }

    /**
     * ディレクトリの作成
     * @test
     */
    public function makeLogDirectory() {
        self::$Log->makeLogDirectory($this->vfs->url('rootdir').'/log');
        $this->assertTrue(vfsStreamWrapper::getRoot()->hasChild('log'));
    }

    /**
     * ログファイルの作成
     * @test
     */
    public function makeLog() {
        $logtext = "Log Text";

        self::$Log->setFilename('test-log.log');
        self::$Log->makeLogDirectory($this->vfs->url('rootdir').'/log');

        self::$Log->makeLog($logtext);

        $log = file_get_contents($this->vfs->url('rootdir').'/log/test-log.log');
        $this->assertEquals($logtext, $log);
    }

    /**
     * ログファイルの削除
     * @test
     */
    public function deleteLog() {
        $logtext = "Log Text";

        self::$Log->setFilename('test-log.log');
        self::$Log->makeLogDirectory($this->vfs->url('rootdir').'/log');

        self::$Log->makeLog($logtext);

        self::$Log->deleteLog();
        $this->assertFalse(vfsStreamWrapper::getRoot()->hasChild('log/test-log.log'));
    }
}