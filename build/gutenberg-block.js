(() => {
    "use strict";
    const e = window.React,
        { registerBlockType: t } = wp.blocks,
        { SelectControl: l } = wp.components,
        { useState: n, useEffect: s } = wp.element;

    t("business-profile-render/bpr-block", {
        title: "Business Profile",
        icon: "admin-site",
        category: "common",
        attributes: {
            option: { type: "string", default: "--" }
        },
        edit: t => {
            const { attributes: a, setAttributes: o } = t,
                { option: i } = a,
                [r, c] = n([]);

            s(() => {
                const e = window.businessProfileData || {},
                    t = Object.entries(e).map(([e, t]) => ({ label: e, value: t }));
                c(t);
            }, []);

            const isImageUrl = (url) => {
                try {
                    // Remove trailing commas before parsing the URL
                    const cleanUrl = url.replace(/,+$/, '');
                    const parsedUrl = new URL(cleanUrl);
                    return parsedUrl.hostname === 'media-prod.apigateway.co';
                } catch (e) {
                    return false;
                }
            };

            const getSocialIcon = (url) => {
                try {
                    const parsedUrl = new URL(url);
                    if (parsedUrl.hostname.includes("facebook.com")) {
                        return "fab fa-facebook";
                    } else if (parsedUrl.hostname.includes("rss")) {
                        return "fab fa-rss";
                    } else if (parsedUrl.hostname.includes("twitter.com")) {
                        return "fab fa-twitter";
                    } else if (parsedUrl.hostname.includes("youtube.com")) {
                        return "fab fa-youtube";
                    } else if (parsedUrl.hostname.includes("foursquare.com")) {
                        return "fab fa-foursquare";
                    } else if (parsedUrl.hostname.includes("instagram.com")) {
                        return "fab fa-instagram";
                    } else if (parsedUrl.hostname.includes("pinterest.com")) {
                        return "fab fa-pinterest";
                    } else if (parsedUrl.hostname.includes("linkedin.com")) {
                        return "fab fa-linkedin";
                    } else {
                        return null;
                    }
                } catch (_) {
                    return null;
                }
            };

            const socialIcon = getSocialIcon(i);

            return (
                e.createElement("div", null,
                    e.createElement(l, {
                        label: "Select which field you want to show",
                        value: i,
                        options: r.map(e => ({ label: e.label, value: e.value })),
                        onChange: e => { o({ option: e }) }
                    }),
                    e.createElement("div", null,
                        isImageUrl(i) ?
                            e.createElement("p", null,
                                e.createElement("span", { className: "css-1imalal" }, "Preview:"),
                                e.createElement("br", null),
                                e.createElement("img", { src: i.replace(/,+$/, ''), alt: "Business Profile Image", style: { width: "100px", height: "100px" } })
                            ) :
                        socialIcon ?
                            e.createElement("p", null,
                                e.createElement("span", { className: "css-1imalal" }, "Preview:"),
                                e.createElement("br", null),
                                e.createElement("a", { href: i, target: "_blank", rel: "noopener noreferrer" },
                                    e.createElement("i", { className: socialIcon })
                                )
                            ) :
                            e.createElement("p", null, i)
                    )
                )
            );
        },
        save: ({ attributes: t }) => {
            const { option: l } = t;

            const isImageUrl = (url) => {
                try {
                    // Remove trailing commas before parsing the URL
                    const cleanUrl = url.replace(/,+$/, '');
                    const parsedUrl = new URL(cleanUrl);
                    return parsedUrl.hostname === 'media-prod.apigateway.co';
                } catch (e) {
                    return false;
                }
            };

            const getSocialIcon = (url) => {
                try {
                    const parsedUrl = new URL(url);
                    if (parsedUrl.hostname.includes("facebook.com")) {
                        return "fab fa-facebook";
                    } else if (parsedUrl.hostname.includes("rss")) {
                        return "fab fa-rss";
                    } else if (parsedUrl.hostname.includes("twitter.com")) {
                        return "fab fa-twitter";
                    } else if (parsedUrl.hostname.includes("youtube.com")) {
                        return "fab fa-youtube";
                    } else if (parsedUrl.hostname.includes("foursquare.com")) {
                        return "fab fa-foursquare";
                    } else if (parsedUrl.hostname.includes("instagram.com")) {
                        return "fab fa-instagram";
                    } else if (parsedUrl.hostname.includes("pinterest.com")) {
                        return "fab fa-pinterest";
                    } else if (parsedUrl.hostname.includes("linkedin.com")) {
                        return "fab fa-linkedin";
                    } else {
                        return null;
                    }
                } catch (_) {
                    return null;
                }
            };

            const socialIcon = getSocialIcon(l);

            return (
                e.createElement("div", null,
                    isImageUrl(l) ?
                        e.createElement("p", null,
                            e.createElement("img", { src: l.replace(/,+$/, ''), alt: "Business Profile Image", style: { width: "100px", height: "auto" } })
                        ) :
                    socialIcon ?
                        e.createElement("p", null,
                            e.createElement("a", { href: l, target: "_blank", rel: "noopener noreferrer" },
                                e.createElement("i", { className: socialIcon })
                            )
                        ) :
                        e.createElement("p", null, l)
                )
            );
        }
    });
})();
