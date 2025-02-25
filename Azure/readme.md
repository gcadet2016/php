# Run the PHP web app localy

```
Run the command line (WSL)
    php -S localhost:8080
```

# Deploy to Azure

Under powershel cmd prompt, login to azure
```
az login --tenant "xxxx"
az account set --subscription "yyyy"
```

## Create web app and deploy
[Doc](https://learn.microsoft.com/en-us/azure/app-service/quickstart-php?tabs=cli&pivots=platform-linux)


```
az webapp up --runtime "PHP:8.3" --os-type=linux --name artists --location "France Central"

```
## Just deploy
[Doc](https://learn.microsoft.com/en-us/azure/app-service/quickstart-php?tabs=cli&pivots=platform-linux)  
zip the files to deploy.zip

```
az webapp deploy --resource-group rg-dev-emea-artists-web --name artists --src-path "C:\Users\guigu\OneDrive\Dev\GitRepositories\php\Azure\deploy.zip"
```