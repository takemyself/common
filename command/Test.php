<?php
/**
 * Created by PhpStorm.
 * User : Leopard
 * Date : 2018/6/8
 * Time : 11:28
 * Email: 417780879@qq.com
 */
namespace app\common\command;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\console\input\Argument;
use think\console\input\Option;
use think\Request;

class Test extends Command{
    protected function configure()
    {
        //command.php  里return ['app\common\command\Test',];
        //运行：php think test index\index\index --(file\controller\function)
        $this->setName('test')
        ->setDefinition([
            new Option('option', 'o', Option::VALUE_OPTIONAL, "命令option选项"),
            new Argument('test',Argument::OPTIONAL,"test参数"),
        ])
            ->setDescription('hello word !');
    }

    /**
     * 重写execute         ---执行入口
     * {@inheritdoc}
     */
    protected function execute(Input $input, Output $output)
    {
        $request = Request::instance([
            'get'=>$input->getArguments(),
            'route'=>$input->getOptions()
        ]);
        $str=$request->get()['test'];
        $ex=strpos($str,'/')?'/':'\\';
        $arr=explode($ex,$str);
        $view=$arr[2];
        $output->writeln(controller($arr[0].'/'.$arr[1])->$view());
    }
}