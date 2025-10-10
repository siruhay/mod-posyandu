<template>
	<form-edit with-helpdesk>
		<template v-slot:default="{ record }">
			<v-card-text>
				<v-row dense>
					<v-col cols="12">
						<v-text-field
							autocomplete="off"
							label="Name"
							v-model="record.name"
							hide-details
						></v-text-field>
					</v-col>

					<v-col cols="8">
						<v-select
							:items="[
								{
									title: 'PDF',
									value: 'application/pdf',
									extns: '.pdf',
								},
								{
									title: 'Word 97-2004',
									value: 'application/msword',
									extns: '.doc',
								},
								{
									title: 'Word 2005+',
									value: 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
									extns: '.docx',
								},
								{
									title: 'Excel 97-2004',
									value: 'application/vnd.ms-excel',
									extns: '.xls',
								},
								{
									title: 'Excel 2005+',
									value: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
									extns: '.xlsx',
								},
							]"
							autocomplete="off"
							label="Mime"
							v-model="record.mime"
							hide-details
						></v-select>
					</v-col>

					<v-col cols="4">
						<v-text-field
							autocomplete="off"
							label="Size (byte)"
							v-model="record.maxsize"
							hide-details
						></v-text-field>
					</v-col>
				</v-row>
			</v-card-text>
		</template>
	</form-edit>
</template>

<script>
export default {
	name: "posyandu-document-edit",
};
</script>
