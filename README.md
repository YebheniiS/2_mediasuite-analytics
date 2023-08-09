# VideoSuite Analytics Service

## Servers
- node1.vidanalytics.io : Interactr Production Pre Evolution 2.0
- node2.vidanalytics.io : Interactr Production Users Created Post Evolution 2.0
- node3.vidanalytics.io : VideoBubble

Each node uses a api_key to differentiate between local / staging data and live data. When building updates to the analytics server you can override the
analytics url in the database for your user to a local url


## Deployment
Projects should be deployed using envoyer.io as we deploy the same copy of the code to all 4 servers.
It's important that all updates are backwards compatible to not break live sites. 

The reason we replicate the same codebase across multiple servers is for performance. Having all analytics going to one server was causing a bottleneck
this allows us to add a new node to an app once a single node is getting slow. We do this by adding the analytics api url to the
user model in the app when new users are created.

## Backups
The production databases are backed up using laravel forge's inbuilt DB backup
