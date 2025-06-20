### Required Fields... ###

# Version of TI's custom web dev box. See local-vagrant repo
$box_version = "2.3.0"

# each project needs a unique IP, last two blocks can be changed.
$ip = '192.168.56.90'

# names of Yii2 apps (we call the modules)
$modules = 'www admin rest'

# Used for box name and domain.
$slug = 'yii2-task-board-app'

### Override if you like... ###

# gets added to later from moduiles later by mapping modules onto domains.
# $domains = {}

# How many cores to assign. (Increase if you're running big Queues)
$cpus = 2

# How much RAM
$memory = 2048

# Gets added to and prints at end of provision.
$post_up_message = ""

# Where's the box loaded from. Normally S3 but can be local file path
# $box_url = "https://s3.eu-west-2.amazonaws.com/toru-static-sites/base-boxes/web_development_"+$box_version+".box"

# What's the box called? Needs to change as URL change
# $box_name = "ti-web-development-"+$box_version

# How many seconds to allow for bootup
# $boot_timeout = 600;

############################################################
require 'open-uri'
if File.exist?('./.ti/local/provision/vagrantfile.rb') == false then
  open('./.ti/local/provision/vagrantfile.rb', 'wb') do |file|
    file << open('https://s3.eu-west-2.amazonaws.com/toru-static-sites/base-boxes/web_development_'+$box_version+'/'+$arch+'/vagrantfile.rb').read
  end
end
load './.ti/local/provision/vagrantfile.rb'
