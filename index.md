---
layout: default
excerpt: "A minimal Jekyll theme for your blog by designer Michael Rose."
tags: [Jekyll, theme, responsive, blog, template]
image:
  feature: sample-image-1.jpg
  credit: WeGraphics
  creditlink: http://wegraphics.net/downloads/free-ultimate-blurred-background-pack/
---
<div id="index">
  <h3><a href="{{ site.baseurl }}/posts/">Recent Posts</a></h3>
  {% for post in site.posts limit:5 %}    
  <article>
    {% if post.link %}
      <h2 class="link-post"><a href="{{ site.baseurl }}{{ post.url }}" title="{{ post.title }}">{{ post.title }}</a> <a href="{{ post.link }}" target="_blank" title="{{ post.title }}"><i class="fa fa-link"></i></h2>
    {% else %}
      <h2><a href="{{ site.baseurl }}{{ post.url }}" title="{{ post.title }}">{{ post.title }}</a></h2>
      <p>{{ post.excerpt | strip_html | truncate: 160 }}</p>
    {% endif %}
  </article>
  {% endfor %}
</div><!-- /#index -->