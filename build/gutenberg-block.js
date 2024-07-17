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
                    const cleanUrl = url.replace(/,+$/, '');
                    const parsedUrl = new URL(cleanUrl);
                    return parsedUrl.hostname === 'media-prod.apigateway.co';
                } catch (e) {
                    return false;
                }
            };

            const getSocialIcon = (url) => {
                let hostname;
                try {
                    const parsedUrl = new URL(url);
                    hostname = parsedUrl.hostname;
                } catch (_) {
                    return null;
                }

                switch (true) {
                    case hostname.includes("facebook.com"):
                        return "fab fa-facebook";
                    case hostname.includes("rss"):
                        return "fab fa-rss";
                    case hostname.includes("twitter.com"):
                        return "fab fa-twitter";
                    case hostname.includes("youtube.com"):
                        return "fab fa-youtube";
                    case hostname.includes("foursquare.com"):
                        return "fab fa-foursquare";
                    case hostname.includes("instagram.com"):
                        return "fab fa-instagram";
                    case hostname.includes("pinterest.com"):
                        return "fab fa-pinterest";
                    case hostname.includes("linkedin.com"):
                        return "fab fa-linkedin";
                    default:
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
                    const cleanUrl = url.replace(/,+$/, '');
                    const parsedUrl = new URL(cleanUrl);
                    return parsedUrl.hostname === 'media-prod.apigateway.co';
                } catch (e) {
                    return false;
                }
            };

            const getSocialIcon = (url) => {
                let hostname;
                try {
                    const parsedUrl = new URL(url);
                    hostname = parsedUrl.hostname;
                } catch (_) {
                    return null;
                }

                switch (true) {
                    case hostname.includes("facebook.com"):
                        return "fab fa-facebook";
                    case hostname.includes("rss"):
                        return "fab fa-rss";
                    case hostname.includes("twitter.com"):
                        return "fab fa-twitter";
                    case hostname.includes("youtube.com"):
                        return "fab fa-youtube";
                    case hostname.includes("foursquare.com"):
                        return "fab fa-foursquare";
                    case hostname.includes("instagram.com"):
                        return "fab fa-instagram";
                    case hostname.includes("pinterest.com"):
                        return "fab fa-pinterest";
                    case hostname.includes("linkedin.com"):
                        return "fab fa-linkedin";
                    default:
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
