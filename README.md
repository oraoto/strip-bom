# strip-bom

快速去除文件的UTF-8 BOM。

# 安装

在[Releases](https://github.com/oraoto/strip-bom/releases)下载最新版本的`strip-bom.phar`即可。

另外还需要安装PHP。

# 使用

移除一个文件的UTF-8 BOM：

~~~
php strip-bom.phar file.txt
~~~

默认会输出到标准输出，可以重定向到新文件：

~~~
php strip-bom.phar file.txt > no-bom.txt
~~~

可以使用`-i`原地修改文件：

~~~
php strip-bom.phar -i file.txt
~~~

调整块大小（默认4096字节）可以控制内存使用和速度：

~~~
php strip-bom.phar -i -b 16384 file.txt
~~~

也可以同时移除多个文件的BOM：

~~~
php strip-bom.phar -i file1.txt file2.txt
~~~
