const { registerBlockType } = wp.blocks;
const { useState, useEffect } = wp.element;
const { ToggleControl, PanelBody, PanelRow } = wp.components;
const { InspectorControls } = wp.blockEditor;
const { __ } = wp.i18n;

registerBlockType('rajan-vijayan/my-block', {
    title: __('My Block', 'rajan-vijayan'),
    icon: 'admin-site',
    category: 'common',

    edit: ({ className, attributes, setAttributes }) => {
        const [data, setData] = useState(attributes.data);
        const [columnVisibility, setColumnVisibility] = useState(attributes.columnVisibility);
        const [loading, setLoading] = useState(true);
        const [error, setError] = useState(null);

        useEffect(() => {
            fetchData();
        }, []);

        const fetchData = () => {
            jQuery.ajax({
                url: myplugin_ajax_object.ajax_url,
                type: 'GET',
                data: {
                    action: 'my_plugin_fetch_data', // AJAX action hook
                    nonce: myplugin_ajax_object.security // Nonce for security
                },
                success: function (response) {
                    console.log(response);
                    setLoading(false);
                    setData(response.data);
                    setError(null);
                },
                error: function (xhr, status, error) {
                    setLoading(false);
                    setError(xhr.responseText || error);
                },
            });
        };

        const toggleColumnVisibility = (columnName) => {
            const newState = {
                ...columnVisibility,
                [columnName]: !columnVisibility[columnName],
            };
            setColumnVisibility(newState);
            // Update the block's attributes with the new columnVisibility state
            setAttributes({ columnVisibility: newState });
        };

        if (loading) {
            return <div className={className}>{__('Loading...', 'miusage-plugin')}</div>;
        }

        if (error) {
            return <div className={className}>{__('Error: Unable to fetch data', 'miusage-plugin')}</div>;
        }

        return (
            <div className={className}>
                <InspectorControls>
                    <PanelBody title='Toggle'>
                        {Object.keys(columnVisibility).map((columnName) => (
                            <PanelRow key={`panel_${columnName}`}>
                                <ToggleControl label={columnName} checked={columnVisibility[columnName]} onChange={() => toggleColumnVisibility(columnName)} />
                            </PanelRow>
                        ))}
                    </PanelBody>
                </InspectorControls>
                <div className='miusage-table-wrapper' dangerouslySetInnerHTML={{ __html: generateTableHTML(data, columnVisibility) }} />
            </div>
        );
    },

    save: () => {
        return null; // Save function is not used as the table is generated dynamically in the frontend
    },

    attributes: {
        data: {
            type: 'object',
            default: null,
        },
        columnVisibility: {
            type: 'object',
            default: {
                id: true,
                fname: true,
                lname: true,
                email: true,
                date: true,
            },
        },
    },
});

const generateTableHTML = (data, columnVisibility) => {
    if (!data) {
        return 'Empty'; // Return empty string if data is not available
    }

    // Generate HTML markup for the table
    let tableHTML = `
        <table class="miusage-table">
            <thead>
                <tr>
                    ${Object.keys(data.data.headers)
                        .map((header) => (columnVisibility[header] ? `<th>${data.headers[header]}</th>` : ''))
                        .join('')}
                </tr>
            </thead>
            <tbody>
                ${Object.values(data.data.rows)
                    .map(
                        (row) => `
                    <tr>
                        ${Object.keys(row)
                            .map((columnName) => (columnVisibility[columnName] ? `<td>${row[columnName]}</td>` : ''))
                            .join('')}
                    </tr>
                `
                    )
                    .join('')}
            </tbody>
        </table>
    `;

    return tableHTML;
};