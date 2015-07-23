<?php defined('BASEPATH') OR exit('No direct script access allowed');

$lang['help_body'] = "
<h6>概观</h6><hr>
<p>文件模块是一个很好的方式，为网站管理员在网站上使用的文件管理。
页，画廊，博客文章中插入图像或文件都存储在这里。
对于页面内容的图像，你可以上传他们直接从所见即所得的编辑器，你可以上传他们在这里，只需插入他们通过所见即所得。</p>
<p>文件的界面很像一个本地文件系统，它使用右键显示上下文菜单。在中间窗格中的一切都是可点击的。</p>

<h6>管理文件夹</h6>
<p>在创建顶级文件夹或文件夹，你可以创建多个子文件夹，你需要，如博客/图片/截图/或网页/音频/。您使用的文件夹名称，名称不显示在前端的下载链接。管理文件夹右击它并选择从菜单或文件夹，双击打开它的行动。你也可以点击左栏中的文件夹，打开它们。
</p>
<p>如果启用了云提供商，您将可以设置文件夹的位置，右击文件夹，然后选择详情。
然后，您可以选择一个位置（例如\“亚马逊S3\”）把远程桶或容器的名字。如果桶或容器
不存在将创建当您单击保存。请注意，你只能改变一个空文件夹的位置。</p>

<h6>管理文件</h6>
<p>管理文件，浏览到的文件夹，在左侧立柱上的文件夹在中间窗格中点击文件夹树。
一旦您正在查看的文件，通过右键点击它们，你可以编辑他们。你还可以订购他们拖入他们的位置。注意
这如果你有相同的父文件夹的文件夹和文件夹将总是首先显示文件。</p>

<h6>上传文件</h6>
<p>上传窗口，右键单击所需的文件夹后会出现。
您可以通过拖放上传文件框，或在框中单击并选择您的标准文件对话框的文件添加文件。
由持有控制/命令或Shift键的同时点击，您可以选择多个文件。选定的文件将显示在屏幕底部的列表。
然后，您可以删除不必要的文件从列表或如果满意单击Upload开始上传过程。</p>
<p>如果你得到一个警告有关文件是规模过大，被告知，许多主机不允许超过2MB的文件上传。
许多现代相机生产5MB exess图像，所以它运行到这个问题是很常见的。
为了弥补这个限制，你可能问你的主机，改变上传限制或上传之前，你不妨调整您的图像。
大小有增加的优势，更快的上传时间。你可能会改变上传限制
CP>文件>设置也却是次要的主机的限制。例如，如果主机允许一个50MB的上传，你仍然可以限制大小
通过设置最大的\“20\”CP（例如）“>”文件“>”设置“上传。</p>

<h6>同步文件</h6>
<p>如果您正在存储与云服务提供商的文件，你可能想使用同步功能。这允许你\“刷新\”
您的数据库文件保持最新与远程存储位置。例如，如果您有其他服务
转储文件到亚马逊上的文件夹，你要显示在您的每周博客文章，你可以简单地去给你的文件夹
链接到该桶，单击同步。这将拉低所有可用的信息，从亚马逊
存储在数据库中，如果该文件通过文件接口上传。文件现在可以被插入到页面内容，
您的博客后，或等，如果文件已被删除，因为您上次同步现在，他们将被删除从远程桶
数据库。</p>

<h6>搜索</h6>
<p>你可以搜索所有文件和文件夹，在右列中键入搜索字词，然后按下回车键。第一
5文件夹的比赛，前5个文件的比赛将被退回。当您单击一个项目上，将显示其包含的文件夹
您的搜索匹配的项目将突出显示。项目使用的文件夹名，文件名，扩展搜索，
位置，远程容器的名称。</p>";