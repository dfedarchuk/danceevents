<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:rss="http://purl.org/rss/1.0/" xmlns="http://www.w3.org/1999/xhtml">
<xsl:output method="html"/>
<xsl:template match="/">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<style type="text/css">
			div.channel-title { font: bold 18px/bold Verdana, Arial, Helvetica, sans-serif; color: black; padding: 5px 0 5px 0}
			div.image { font: normal 11px/normal Verdana, Arial, Helvetica, sans-serif; color: black; border:0; padding: 5px 0 5px 0}
			table.item { width: 750px; border: 0;}
			table.item th { font: bold 13px/bold Verdana, Arial, Helvetica, sans-serif; color: black; vertical-align: top; text-align: right;}
			table.item td { font: normal 11px/normal Verdana, Arial, Helvetica, sans-serif; color: black; }
			.line { border-top: 1px solid black; }
			a {color: black;}
		</style>
		<title>
			<xsl:for-each select="rss/channel">
				<xsl:value-of select="description"/>
			</xsl:for-each>
		</title>
	</head>
	<body>
		<xsl:for-each select="rss/channel/image">
			<center>
				<div class="image">
				<xsl:element name="a">
					<xsl:attribute name="href"><xsl:value-of select="link"/></xsl:attribute>
					<xsl:element name="img">
						<xsl:attribute name="src"><xsl:value-of select="url"/></xsl:attribute>
						<xsl:attribute name="alt"><xsl:value-of select="title"/></xsl:attribute>
						<xsl:attribute name="border">0</xsl:attribute>
					</xsl:element>
				</xsl:element>
				</div>
			</center>
		</xsl:for-each>
		<xsl:for-each select="rss/channel">
			<center>
				<div class="channel-title">
					<xsl:element name="a">
						<xsl:attribute name="href"><xsl:value-of select="link"/></xsl:attribute>
						<xsl:value-of select="title"/>
					</xsl:element>
				</div>
			</center>
		</xsl:for-each>
		<table align="center" class="item">
			<xsl:for-each select="rss/channel/item">
				<tr>
					<td>
						<table>
							<tr>
								<th>Title:</th>
								<td>
									<xsl:element name="a">
										<xsl:attribute name="href"><xsl:value-of select="link"/></xsl:attribute>
										<xsl:value-of select="title"/>
									</xsl:element>
								</td>
							</tr>
							<tr>
								<th>Description:</th>
								<td>
									<xsl:value-of select="description"/>
								</td>
							</tr>
							<xsl:if test="url">
								<tr>
									<th>URL:</th>
									<td>
										<xsl:value-of select="url"/>
									</td>
								</tr>
							</xsl:if>
							<xsl:if test="address">
								<tr>
									<th>Address:</th>
									<td>
										<xsl:value-of select="address"/>
									</td>
								</tr>
							</xsl:if>
							<xsl:if test="phone">
								<tr>
									<th>Phone:</th>
									<td>
										<xsl:value-of select="phone"/>
									</td>
								</tr>
							</xsl:if>
							<xsl:if test="email">
								<tr>
									<th>E-mail:</th>
									<td>
										<xsl:value-of select="email"/>
									</td>
								</tr>
							</xsl:if>
						</table>
					</td>
					<xsl:if test="img_src">
						<td>
							<table>
								<tr>
									<td>
										<xsl:element name="img">
											<xsl:attribute name="src"><xsl:value-of select="img_src"/></xsl:attribute>
											<xsl:attribute name="alt"><xsl:value-of select="title"/></xsl:attribute>
											<xsl:attribute name="width"><xsl:value-of select="img_width"/></xsl:attribute>
											<xsl:attribute name="height"><xsl:value-of select="img_height"/></xsl:attribute>
											<xsl:attribute name="border">0</xsl:attribute>
										</xsl:element>
									</td>
								</tr>
							</table>
						</td>
					</xsl:if>
				</tr>
				<tr><td colspan="2" class="line"><xsl:text>&#160;</xsl:text></td></tr>
			</xsl:for-each>
		</table>
	</body>
</html>
</xsl:template>
</xsl:stylesheet>