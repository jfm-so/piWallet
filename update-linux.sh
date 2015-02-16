#Coming Soon/Beta - Do Not Use
echo "This will delete all custom development. Your Database and config file will not be updated"
read -p "Press [Enter] key to confirm"
rm -r assets/
rm -r classes/
rm -r view/
rm README.md
rm index.php
rm jsonRPCClient.php
git clone git@github.com:piWallet/piWallet.git .
