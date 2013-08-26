LinkPreview
===========

A PHP file that, when given a url, will return a JSON object containing the name, description, and an image url. 

Intended to help generate link previews like Facebook and Twitter do.

Simply host the file on a server supporting php, and pass in the url you want to preview, as the url parameter 'link'
Ex: "http://jacob-petersen.com/LinkPreview.php?link=http://www.foxnews.com/us/2013/08/25/new-york-attorney-general-sues-donald-trump-for-40m-claiming-trump-university/"

If you want to support JSONP, there is code to support that, that is currently commented out.
The block starts on line 56.
Just uncomment it to start supporting JSONP
