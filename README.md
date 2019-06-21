Q-invoice XML API
===============
For simple communication between third party software and q-invoice we suggest using the XML API.

## URL
The latest version of our API can be found at https://app.q-invoice.com/api/xml/1.2/

## Example request
```xml
<request>
	<login mode="newInvoice">
		<username>api_username</username>
		<password>api_password</password>
	</login>
	<invoice>
		<companyname>q-invoice.nl</companyname>
		<firstname>Casper</firstname>
		<lastname>Mekel</lastname>
		<email>info@q-invoice.nl</email>
		<phone>0702206233</phone>
		<address>Postbus 7216</address>
		<address2></address2>
		<zipcode>2701 AE</zipcode>
		<city>Zoetermeer</city>
		<country>NL</country>
		<delivery_companyname>q-invoice</delivery_companyname>
		<delivery_firstname>Casper</delivery_firstname>
		<delivery_lastname>Mekel</delivery_lastname>
		<delivery_address>Postbus 7216</delivery_address>
		<delivery_address2></delivery_address2>
		<delivery_zipcode>2701 AE</delivery_zipcode>
		<delivery_city>Zoetermeer</delivery_city>
		<delivery_country>NL</delivery_country>
		<vat>VAT NUMBER</vat>
		<iban>Client IBAN</iban>
		<bic>Client BIC</bic>
		<remark>A short description or remark</remark>
		<layout>Layoutcode</layout>
		<paid method="betaalmethode">boolean</paid>
		<action>boolean</action>
		<calculation_mode>excl</action>
		<tags>
			<tag>something</tag>
			<tag>something_else</tag>
		</tags>
		<items>
		    <item>
		        <quantity>100</quantity>
		        <code>Product code</code>
		        <description>Product row 1</description>
		        <price>5000</price>
		        <price_vat>1050</price_vat>
		        <price_incl>6050</price_incl>
		        <vatpercentage>2100</vatpercentage>
		        <discount>500</discount>
		        <quantity>100</quantity>
		        <ledgeraccount>8000</ledgeraccount>
		    </item>
		</items>
	</invoice>
</request>
```

## Fields

Most fields are self-explanatory, other fields we'll explain here. All numerical (quantity, price) fields need to be multiplied by 100.

**calculation_mode**
Use this field to set the way totals are calculated. Especially when you experience rounding errors between your webshop and q-invoice changing this value might help.

**action**
The document action after it has been created. 
0 = save as draft
1 = save as PDF
2 = save as PDF and send per mail

**paid**
1 for paid in full, 0 for unpaid