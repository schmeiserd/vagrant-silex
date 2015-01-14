Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty32"
  config.vm.provision :shell, path: "./provision/bootstrap.sh"
  config.vm.network :forwarded_port, host: 8001, guest: 80
  config.vm.synced_folder "./silex", "/var/www/"
  config.vm.synced_folder "./provision", "/home/vagrant/provision"
end