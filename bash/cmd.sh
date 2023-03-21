for e in `ps ax | grep '\/code\/' | awk '{printf "%d ", $1}'`; do echo "[$e]"; kill -9 $e; done
for p in `ps ax | awk '{printf "[%d]-%s ",$1,$5}'`; do echo $p; done
for file in `find /var/www/projects/codewars/ -type f -not -path "*.git*"`; do echo "[$file]"; done