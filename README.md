# Imggregator

An image aggregator!

## What is it?

It's like an image gallery, only you don't upload images and you don't have to create categories!

Still following? No? It's fine, let's go over what it will do:

* Pull images from third-party image hosting sites, like Instagram, Flickr, or Imgur. (see **Hooks!** below)
* Allow you to display these images on a gallery like page.
* A menu item will be provided so you can display a single image, with various options on retrieval.
* The shortcodes and template system will be used so you can make your gallery page as customized as you wish.

## What about uploading images?

Well, not right now. There's other gallery plugins for e107 (there's one included with e107!) and I have no interest in mimicing their functionality right now. Maybe in the future when I've exhausted all other third-party options that interest me (or you!).

**But, e107 has the media manager that could be considered a third-party image hosting service!!!**

Yeah, I guess. But the answer is still "not right now."! Take a look at the gallery plugin included in e107, it does a fantastic job of pulling images from the media manager. I mean, you could use both.

## The most important step..

.. is to **make sure** you CHMOD the `images/` directory to be writable (777) so that your images can be cached!

## Translations

Not right now. Multilingual support will come, but not until more of the plugin is completed. Stick around!

(Note: the method for submiting translations will be the same as most other plugins hosted on GitHub: fork the repo, submit a pull request.)

# Hooks!

Whats? Hooks! They are what third-party services will be referred to. There's more information on the Wiki!

## Which Hooks?

These hooks:

* [Instagram](https://github.com/septor/imggregator/wiki/Instagram+Hook)
* [Flickr](https://github.com/septor/imggregator/wiki/Flickr+Hook)


# IMPORTANT NOTICE

Although I don't think it relates to the _Cookie Law_, you should take note that sites using this plugin will be potentially caching images from third-party websites into your browser (it's almost as dirty as it sounds). If you are **not** fine with this, you need to contact them and plea your case.

Finally, **I, Patrick Weaver, am not responsible for the content that could potentially be presented to you. If you have an issue, take it up with the person running the website that my plugin is used on, not me.** If you come to me I will laugh at and ignore your complaint. Period.
