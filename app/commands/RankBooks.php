<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RankBooks extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'books:rank';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate a new user';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $date = new DateTime;
        $date->modify('yesterday');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $books = Book::where('updated_at', '<', $formatted_date)->orderBy('updated_at','asc')->take(50)->get();
        foreach($books as $book) {
            sleep(0.6);
            echo "update " . $book->name;
            $result = $this->updateBook($book);
            echo "\n";
            if ($result == false) {
                break;
            }
        }
	}

    public function updateBook($book) {
        $urlTpl = "https://api.douban.com/v2/book/search?q=%s";
        $url = sprintf($urlTpl, urlencode($book->name));
        try {
            $json = file_get_contents($url);
        } catch(ErrorException $e) {
            return false;
        }
        $infos = json_decode($json, true);
        if (count($infos['books']) <= 0) {
            return true;
        }
        $info = $infos['books'][0];
        $book->mark = $info['rating']['average'];
        $book->mark_users = $info['rating']['numRaters'];
        $book->save();
        return true;
    }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
//	protected function getArguments()
//	{
//		return array(
//			array('example', InputArgument::REQUIRED, 'An example argument.'),
//		);
//	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
