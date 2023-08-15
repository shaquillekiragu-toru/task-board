# Update queues

echo "Loading $1 queue from $2"

if test -f "/etc/supervisord.conf"; then
	supervisord_file_location="/etc/supervisord.conf"
else
	supervisord_file_location="/etc/supervisor/conf.d/rabbit.conf"
fi

if test -f "$2/queue"; then
  start_tag=";${1}_start"
  end_tag=";${1}_end"
  touch /tmp/queue_file
  touch $supervisord_file_location
  cat $supervisord_file_location > /tmp/queue_file
  if ! grep -Fxq "$start_tag" /tmp/queue_file
  then
    printf "\n$start_tag\n" >> /tmp/queue_file
    printf "$end_tag\n" >> /tmp/queue_file
  fi
  start_tag="^$start_tag"
  end_tag="^$end_tag"
  sed -i -e "/$start_tag/,/$end_tag/{ /$start_tag/{p; r $2/queue
          }; /$end_tag/p; d }"  /tmp/queue_file
  cat /tmp/queue_file > $supervisord_file_location
  rm /tmp/queue_file
fi
