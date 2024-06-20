
# Business Profile Render

**Contributors:** Website Pro Team  
**Tags:** Business, Local SEO, WebsitePro  
**Requires PHP:** 7.4  
**Requires at least:** 6.0
**Tested up to:** 6.5.3  

## Description

This plugin provides tools to display business information easily and automatically.
The hosting platform syncs the relevant business information to the WP Options table.
This plugin provides ways to automatically render this information on your site.

This includes both [Shortcodes](https://codex.wordpress.org/Shortcode) and [Gutenberg Components](https://developer.wordpress.org/block-editor/reference-guides/components/).
### Shortcodes

#### How to use this shortcode

To utilize this shortcode, follow the format below:

**[business_profile attr="company_name"]**

Here, the `attr` parameter specifies the attribute you want to display. Replace `"company_name"` with the desired attribute you wish to retrieve from the business profile.

**For example:** if you want to display the company's name, you would use `"company_name"` as the attribute value. Similarly, you can replace it with other attributes such as address, phone number, or any other pertinent information stored in the business profile.

Make sure to enclose the attribute name within double quotation marks (" "). This ensures that the shortcode accurately identifies the attribute you intend to retrieve.

| Shortcode | Attribute | Preview |
|--|--|--|
|`[business_profile]`| company_name | ABC Media Pvt Ltd |
|`[business_profile]`| description | |
|`[business_profile]`| short_description |  |
|`[business_profile]`| services_offered |  |
|`[business_profile]`| contact_first_name |  |
|`[business_profile]`| contact_last_name |  |
|`[business_profile]`| contact_email |hello@abcmedia.com |
|`[business_profile]`| cell_number |  |
|`[business_profile]`| fax_number |  |
|`[business_profile]`| toll_free_number |  |
|`[business_profile]`| work_number | '+99 879 00 12 12' |
|`[business_profile]`| address | 123 4th Street |
|`[business_profile]`| city | Fairbanks |
|`[business_profile]`| state | Alaska |
|`[business_profile]`| country | United States |
|`[business_profile]`| zip | 99654 |
|`[business_profile]`| time_zone |  |
|`[business_profile]`| longitude | -1.8769149 |
|`[business_profile]`| latitude | 37.1418673 |
|`[business_profile]`| hours_of_operation |  |
|`[business_profile]`| rss_url |  |
|`[business_profile]`| twitter_url |  |
|`[business_profile]`| foursquare_url |  |
|`[business_profile]`| facebook_url |  |
|`[business_profile]`| youtube_url |  |
|`[business_profile]`| instagram_url |  |
|`[business_profile]`| pinterest_url |  |
|`[business_profile]`| linkedin_url |  |
|`[business_profile]`| tax_ids |  |


### Old Shortcodes

Our "Business Profile Data" and "Business Profile Render" plugins use distinct shortcodes and operate on separate versions 1.2.0 and 1.5.0.

| Shortcode | Description | Preview |
|--|--|--|
|`[business-profile-render-company-name] & [business-profile-data-company-name]`| Company Name | ABC Media Pvt Ltd |
|`[business-profile-render-full-address] & [business-profile-data-full-address]`|Full Address|123, Sample Address, CA - 12345|
|`[business-profile-render-address] & [business-profile-data-address]`|Address|123, Sample Address
|`[business-profile-render-city] & [business-profile-data-city]`|City|Saskatoon
|`[business-profile-render-state] & [business-profile-data-state]`|State|Saskatchewan
|`[business-profile-render-zip-code] & [business-profile-data-zip-code]`|ZIP Code|12345
|`[business-profile-render-country] & [business-profile-data-country]`|Country|Canada
|`[business-profile-render-work-number] & [business-profile-data-work-number]`|Work Number|8877665544
|`[business-profile-render-toll-free-number] & [business-profile-data-toll-free-number]`|Toll Free Number|1800-000-000
|`[business-profile-render-hours-of-operation] & [business-profile-data-hours-of-operation]`|Working Hours|
|`[business-profile-render-company-description] & [business-profile-data-company-description]`|Description|
|`[business-profile-render-company-short-description] & [business-profile-data-company-short-description]`|Short Description|
|`[business-profile-render-primary] & [business-profile-data-primary]`|Primary|
|`[business-profile-render-logo] & [business-profile-data-logo]`|Logo|
|`[business-profile-render-services] & [business-profile-data-services]`|Services|
|`[business-profile-render-image-link-foursquare-url] & [business-profile-data-image-link-foursquare-url]`|| Foursquare Link
|`[business-profile-render-image-link-twitter-url] & [business-profile-data-image-link-twitter-url]`|| Twitter Link
|`[business-profile-render-image-link-instagram-url] & [business-profile-data-image-link-instagram-url]`|| Instagram Link
|`[business-profile-render-image-link-linkedin-url] & [business-profile-data-image-link-linkedin-url]`|| LinkedeIn Link
|`[business-profile-render-image-link-pinterest-url] & [business-profile-data-image-link-pinterest-url]`|| Pinterest Link
|`[business-profile-render-image-link-facebook-url] & [business-profile-data-image-link-facebook-url]`|| Facebook Link
|`[business-profile-render-image-link-rss-url] & [business-profile-data-image-link-rss-url]`|| RSS Link
|`[business-profile-render-image-link-youtube-url] & [business-profile-data-image-link-youtube-url]`|| Youtube Link


### Credits

1. Thanks [Font Awesome](https://fontawesome.com/license/free)