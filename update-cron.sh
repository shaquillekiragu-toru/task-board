# Update crontab

echo "Loading $1 cron from $2"

if test -f "$2/cron"; then
  start_tag="#${1}_start"
  end_tag="#${1}_end"
  crontab -l > /tmp/cron_file
  if ! grep -Fxq "$start_tag" /tmp/cron_file
  then
    printf "\n$start_tag\n" >> /tmp/cron_file
    printf "$end_tag\n" >> /tmp/cron_file
  fi
  start_tag="^$start_tag"
  end_tag="^$end_tag"
  sed -i -e "/$start_tag/,/$end_tag/{ /$start_tag/{p; r $2/cron
          }; /$end_tag/p; d }"  /tmp/cron_file
  cat /tmp/cron_file | crontab -
  rm /tmp/cron_file
fi
