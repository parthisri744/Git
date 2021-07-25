<?php
class Model {

    public function run($commend,$output=''){
       $output=  system($commend,$output);
       var_dump($output);
       echo "commends :".$commend;
       // return "<pre>".$output."</pre>";
    }
    public  function runbtn($label,$class="btn btn-success",$cmd,$output){
        echo '<input type="submit" value="'.$label.'" class="'.$class.'" onclick="'.$this->run($cmd,$output).'" />';
    }
    public static function shell_exec($cmd){
      $output=  shell_exec($cmd);
      return "<pre>".$output."</pre>";
    }
    public static function exec($cmd,$array){
        return exec($cmd,$array);
    }

}
/*
Gunzip :
gunzip command is used to compress or expand a file or a list of files in Linux.
It accepts all the files having extension as .gz, .z, _z, -gz, -z , .Z, .taz or.tgz 
and replace the compressed file with the original file by default. 
The files after uncompression retain its actual extension.

Syntax : gunzip [Option] [archive name/file name]
Syntax(uncompress) : gunzip [file1] [file2] [file3]...

Options: 
-c :This option is used to view the text within a compressed file without uncompressing it
-f: To decompress a file forcefully.
-k: This option can be used when we want to keep both the file i.e.
 the uncompressed and the original file after the uncompression.
 -l: This option is used to get the information of a compressed or an uncompressed file.
 -L: This option displays the software license and exit
 -r: This option is used to uncompress all the files within the folder and subfolder recursively
 -t: To test whether the file is valid or not
 -v: This option is used to get verbose information such as the file name, decompression percentage, etc.
 -V: This option is used to display version number
 -d: This option simply decompresses a file
 -h: This option displays the help information available and quits.
-n: This option does not save or restore the original name and time stamp while decompressing a file.
-N: This option saves or restore the original name and time stamp while decompression.
-q: This option suppresses all the warnings that arise during the execution of the command.
-s: This option use suffix SUF on compressed files.
-#: This option is used to control the speed and the amount of compression, where # can be any number between -1 to -9. -1 ensures the faster compression by decreasing the amount of compression while -9 ensures the best compression but takes more time comparatively
If you're trying to run a command such as "gunzip -t" in shell_exec and getting an empty result, you might need to add 2>&1 to the end of the command, eg:

Won't always work:
echo shell_exec("gunzip -c -t $path_to_backup_file");

Should work:
echo shell_exec("gunzip -c -t $path_to_backup_file 2>&1");

System  :
The system() function accepts the command as a parameter and it outputs the result.

The exec() function accepts a command as a parameter but does not output the result. If a second optional parameter is specified, the result will be returned as an array. 
Otherwise, only the last line of the result will be shown if echoed.
*/
?>
