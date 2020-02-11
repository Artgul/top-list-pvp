<?php
    echo "parsing data\n";
        $str = file_get_contents('https://pathofninja.com/rating/pl');
        $re = '/(?:.*?pl=)(.*?)\".*?\n.*">(\d{1,6})/';
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
        $nicks = 'date';
        $date = date('Ymd');
        $scores = $date;
        $length = count($matches);

        for ($i = 0; $i < $length; $i++) {
            $nicks .= ',' . $matches[$i][1];
            $scores .= ',' . $matches[$i][2];
        }

        $year = date('Y');

        $filename = '/' . $year . '.csv';
        $data = $nicks . "\n";
        $data .= $scores . "\n";
    echo "writing data to a file\n";
        $fp = fopen(__DIR__ . $filename, "a"); // Открываем файл в режиме дозаписи
        fwrite($fp, $data);
        fclose($fp); //Закрытие файла
    
    echo "Commiting to git...\n";
        shell_exec("top-list-pvp/command.sh");
    echo "git commit done...\n";