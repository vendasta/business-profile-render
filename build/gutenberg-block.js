(() => {
    "use strict";
    const e = window.React,
        { registerBlockType: t } = wp.blocks,
        { SelectControl: l } = wp.components,
        { useState: n, useEffect: s } = wp.element;

    const parseUrl = (url) => {
        try {
            const cleanUrl = url.replace(/,+$/, '');
            return new URL(cleanUrl);
        } catch (e) {
            return null;
        }
    };

    const isImageUrl = (url) => {
        const parsedUrl = parseUrl(url);
        return parsedUrl && parsedUrl.hostname === 'media-prod.apigateway.co';
    };

    const getSocialIcon = (url) => {
        const parsedUrl = parseUrl(url);
        if (!parsedUrl) return null;
        const { hostname } = parsedUrl;

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

    const Preview = ({ url }) => {
        const socialIcon = getSocialIcon(url);
        return (
            e.createElement("div", null,
                isImageUrl(url) ?
                    e.createElement("p", null,
                        e.createElement("span", { className: "css-1imalal" }, "Preview:"),
                        e.createElement("br", null),
                        e.createElement("img", { src: url.replace(/,+$/, ''), alt: "Business Profile Image", style: { width: "100px", height: "100px" } })
                    ) :
                socialIcon ?
                    e.createElement("p", null,
                        e.createElement("span", { className: "css-1imalal" }, "Preview:"),
                        e.createElement("br", null),
                        e.createElement("a", { href: url, target: "_blank", rel: "noopener noreferrer" },
                            e.createElement("i", { className: socialIcon })
                        )
                    ) :
                    e.createElement("p", null, url)
            )
        );
    };

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

            return (
                e.createElement("div", null,
                    e.createElement(l, {
                        label: "Select which field you want to show",
                        value: i,
                        options: r.map(e => ({ label: e.label, value: e.value })),
                        onChange: e => { o({ option: e }) }
                    }),
                    e.createElement(Preview, { url: i })
                )
            );
        },
        save: ({ attributes: t }) => {
            const { option: l } = t;
            return e.createElement(Preview, { url: l });
        }
    });
})();
