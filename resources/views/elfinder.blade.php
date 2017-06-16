<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>elFinder 2.1.x source version with PHP connector</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />

		<!-- Require JS (REQUIRED) -->
		<!-- Rename "main.default.js" to "main.js" and edit it if you need configure elFInder options or any things -->
		<script data-main="{{ asset('vendor/elfinder/js/main.js') }}" src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.2/require.min.js"></script>
		<script>
			define('elFinderConfig', {
				// elFinder options (REQUIRED)
				// Documentation for client options:
				// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
				defaultOpts : {
					url : '{{ route('elfinder.connector') }}' // connector URL (REQUIRED)
                    ,getFileCallback : function(file, fm) {
                        if (!parent.tinymce) {
                            return;
                        }
        				// pass selected file data to TinyMCE
        				parent.tinymce.activeEditor.windowManager.getParams().oninsert(file, fm);
        				// close popup window
        				parent.tinymce.activeEditor.windowManager.close();
        			}
                    ,soundPath: '{{ route('elfinder.elfinder').'/sounds/' }}'
                    ,sync: 5000
                    ,resizable: false
                    ,height: '100%'
                    ,ui: ['toolbar', 'places', 'tree', 'path', 'stat']
                    ,customData: {
                        _token: '{{ $token }}'
                    }
					,commandsOptions : {
						edit : {
							extraOptions : {
								// set API key to enable Creative Cloud image editor
								// see https://console.adobe.io/
								creativeCloudApiKey : '',
								// browsing manager URL for CKEditor, TinyMCE
								// uses self location with the empty value
								managerUrl : ''
							}
						}
						,quicklook : {
							// to enable preview with Google Docs Viewer
							googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
						}
					}
				},
				managers : {
					// 'DOM Element ID': { /* elFinder options of this DOM Element */ }
					'elfinder': {}
				}
			});
		</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder" style="height:100%;"></div>

	</body>
</html>
