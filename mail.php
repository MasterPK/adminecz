<?php
exec("echo 'Registrace proběhla úspěšně!\nDobrý den ".$_POST['Fname']." ".$_POST['Lname'].',\n Vaše registrace na webu AdminECZ proběhla úspěšně!\nVaše uživatelské jméno: '.$_POST['username']"
            > /mnt/sda1/web/1/test1.txt");
        exec("/mnt/sda1/web/1/mail.sh");
        exec("rm /mnt/sda1/web/1/test1.txt");
php?>