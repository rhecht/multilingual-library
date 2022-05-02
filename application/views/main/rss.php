<?php  echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">
<channel>
<?php foreach ($records as $key => $items): ?>
	<item>
	    <title><![CDATA[<?php echo xml_convert($items->Title); ?>]]></title>
	    <source url="<?php echo $items->URL ?>"><![CDATA[<?php echo xml_convert($items->Publication);?>]]></source>
		<?php /*<atom:link href="<?php echo site_url('rss') ?>" rel="self" type="application/rss+xml" />*/?>
	    <link><?php echo $items->URL ?></link>
	    <guid><?php echo $items->URL ?></guid>
	    <mediatype><?php echo $items->MediaType ?></mediatype>
	    <abstract><![CDATA[<?php echo xml_convert($items->Abstract); ?>]]></abstract>
	    <keywords><![CDATA[<?php echo xml_convert($items->Keywords); ?>]]></keywords>
	    <pubDate><?php echo $items->PublicationYear ?></pubDate>
	    <size><?php echo $items->Size ?></size>
	    <languageid><?php echo $items->LanguageID ?></languageid>
	    <mediatypeid><?php echo $items->MediaTypeID ?></mediatypeid>
	    <status><?php echo $items->status ?></status>				
	    <description><![CDATA[ <?php echo character_limiter( xml_convert($items->Abstract) , 200); ?> ]]></description>
	    <pubDate><?php echo $items->PublicationYear; ?></pubDate>
	</item>    
<?php endforeach; ?>
</channel>
</rss>