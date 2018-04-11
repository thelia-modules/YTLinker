# YT Linker

Allows you to add, modify and store Youtube video IDs in a list to be used with a video player in your site.

## Installation

### Manually

* Copy the module into ```<thelia_root>/local/modules/``` directory and be sure that the name of the module is YTLinker.
* Activate it in your thelia administration panel

### Composer

Add it in your main thelia composer.json file

```
composer require your-vendor/yt-linker-module:~1.0
```

## Usage

After installing the module and activating it in your admin panel, a new button will show up in the tool menu on the
left sidebar (YTLinker), allowing you to access the list.
Once on the list page, you can either add a new video ID by clicking the plus button positioned at the top right of
the page or edit an existing one by clicking on its name or on the cog button on the left, then on the pen button.
You can also delete an entry of the list by clicking on the cog button, then on the trash button.

When adding or editing an entry, you will be asked to enter a title (mandatory), link (mandatory) and a description
(optional) for the video. The link should be a youtube video ID (the part between v= and and a potential &). If you
enter a valid youtube link, the module will automatically keep the video ID and delete the rest.

Example :

https://www.youtube.com/watch?v=dQw4w9WgXcQ

http://youtu.be/dQw4w9WgXcQ

https://www.youtube.com/embed/dQw4w9WgXcQ

https://www.youtube.com/watch?v=dQw4w9WgXcQ&list=RDdQw4w9WgXcQ

Entering either one of these links would add "dQw4w9WgXcQ" to the entry instead of the whole link.

If you enter a non valid youtube link, the link part of the entry will then just be a hard copy of what you
wrote.

## Hook

YTLinker has one hook linking the module panel and video ID list (/admin/tools/YTLinker) to a button in the tools menu on the left sidebar of the 
admin panel.

## Loop

Use this loop to provide you all selection you have.

[ytlinker_list]

This loop returns the list of youtube link.

### Input arguments

|Argument          |Description |
|---               |--- |
|**id**            | video id |
|**title**         | video title |
|**link**          | video link |
|**description**   | video description |
|**position**      | video position in the list |

### Output arguments

|Variable               |Description |
|---                    |--- |
|**ID**                 | video id |
|**TITLE**              | video title |
|**LINK**               | video link |
|**DESC**               | video description |
|**POSITION**           | video position in the list |

### Exemple
````
    {loop name="ytlinker" type="ytlinker_list"}
        id          : {$ID}
        title       : {$TITLE}
        link        : {$LINK}
        description : {$DESC}
        position    : {$SELECTION_POSITION}
    {/loop}
````
