# Documentation for weather API and SMS API test
## How to run
Place the test folder in your localhost with index.php at your public directory

navigate to index.php with your vhost and open the URL the implementation will initialize

### How to do perform the repetition of the call
In order to run the script every 10 minutes a cron must be created with the following script 

```bash
crontab -u www-data -e
```
replace the php exec file and public index file paths

``*/10 * * * * </usr/bin/php> </public_path/index.php>``

## Extra notes
The error_log.txt logs the handled exceptions
