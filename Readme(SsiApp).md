###前言
Bootstrap默认版本3.3.5  
Admin-LTE默认版本2.3.2

###关于升级[z-song/laravel-admin]
```
#本地克隆
git clone git@github.com:ssiapp/laravel-admin.git .
#配置原仓库的路径
git remote add upstream git@github.com:z-song/laravel-admin.git
#查看仓库路径
git remote -v
#抓取原仓库的修改
git fetch upstream
#切换当前分支至master
git checkout master
#合并远程原仓库分支与本地master分支
git merge upstream/master
#推送合并至远程的fork的仓库
git push

```
复制laravel-admin/resources/lang/en到resources/lang/en, 同理zh-CN zh-TW

 
###更新记录
####最新190228
- 基于版本~1.6.9(master), 
- 版本节点：https://github.com/z-song/laravel-admin/tree/a8cdc98a6a84bd1cf7cb83334397f9e1e54e086b
- 修改的文件：  
  composer.json  
  src/Auth/Database/Menu.php  
  src/Form.php  
  src/Grid.php  
  src/Grid/Displayers/Image.php  
  src/Grid/Filter.php  
  src/helpers.php  
  src/Traits/ModelTree.php  


- 添加的文件：  
  Readme(SsiApp).md  
  resources/views/form/neditor.blade.php  
  src/Controllers/ContentHeader.php  
  src/Controllers/CrudActions.php  
  src/Controllers/CrudControllerActions.php  
  src/Database/AdminMigration.php  
  src/Database/AdminSeeder.php  
  src/Extensions/Column/PopOver.php  
  src/Extensions/Form/NEditor.php  
  src/Extensions/Row/ExpandMore.php  


